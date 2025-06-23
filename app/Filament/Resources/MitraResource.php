<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MitraResource\Pages;
use App\Filament\Resources\MitraResource\RelationManagers;
use App\Models\Mitra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Humaidem\FilamentMapPicker\Fields\OSMMap;

class MitraResource extends Resource
{
    protected static ?string $model = Mitra::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Mitra';

    protected static ?string $pluralModelLabel = 'Mitra';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('User')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                
                                Forms\Components\TextInput::make('business_name')
                                    ->label('Nama Bisnis')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('service_category_id')
                                    ->label('Kategori Layanan')
                                    ->relationship('serviceCategory', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                
                                Forms\Components\TagsInput::make('service_area')
                                    ->label('Area Layanan')
                                    ->placeholder('Tambahkan area layanan')
                                    ->helperText('Tekan Enter untuk menambah area baru'),
                            ]),
                    ])
                    ->columns(1),

                Section::make('Lokasi')
                    ->schema([
                        OSMMap::make('location')
                            ->label('Pilih Lokasi')
                            ->showMarker()
                            ->draggable()
                            ->extraControl([
                                'zoomDelta' => 1,
                                'zoomSnap' => 0.25,
                                'wheelPxPerZoomLevel' => 60
                            ])
                            ->tilesUrl('https://tile.openstreetmap.org/{z}/{x}/{y}.png')
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                            })
                            ->extraAttributes(['class' => 'h-[400px]'])
                            ->columnSpanFull(),
                        
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->placeholder('Contoh: -7.250445')
                                    ->reactive(),
                                
                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric()
                                    ->step(0.000001)
                                    ->placeholder('Contoh: 112.768845')
                                    ->reactive(),
                            ]),
                    ]),

                Section::make('Foto')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('profile_photo')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('mitra/profile')
                                    ->visibility('public'),
                                
                                Forms\Components\FileUpload::make('cover_photo')
                                    ->label('Foto Cover')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('mitra/cover')
                                    ->visibility('public'),
                            ]),
                    ]),

                Section::make('Verifikasi')
                    ->schema([
                        Forms\Components\Toggle::make('is_verified')
                            ->label('Terverifikasi')
                            ->helperText('Centang jika mitra sudah terverifikasi'),
                    ]),

                Section::make('Statistik')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('avg_rating')
                                    ->label('Rating Rata-rata')
                                    ->numeric()
                                    ->step(0.1)
                                    ->minValue(0)
                                    ->maxValue(5)
                                    ->helperText('Rating dari 0 sampai 5'),
                                
                                Forms\Components\TextInput::make('completed_jobs')
                                    ->label('Pekerjaan Selesai')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder-avatar.png')),
                
                Tables\Columns\TextColumn::make('business_name')
                    ->label('Nama Bisnis')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('serviceCategory.name')
                    ->label('Kategori')
                    ->searchable()
                    ->badge(),
                
                Tables\Columns\TextColumn::make('service_area')
                    ->label('Area Layanan')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return implode(', ', array_slice($state, 0, 2)) . 
                                   (count($state) > 2 ? ' +' . (count($state) - 2) : '');
                        }
                        return $state ?? '-';
                    })
                    ->wrap(),
                
                IconColumn::make('is_verified')
                    ->label('Verifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('avg_rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) . '/5' : 'Belum ada')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 4.5 => 'success',
                        $state >= 3.5 => 'warning',
                        $state >= 2.5 => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('completed_jobs')
                    ->label('Pekerjaan')
                    ->formatStateUsing(fn ($state) => $state . ' selesai')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('service_category_id')
                    ->label('Kategori Layanan')
                    ->relationship('serviceCategory', 'name')
                    ->searchable()
                    ->preload(),
                
                TernaryFilter::make('is_verified')
                    ->label('Status Verifikasi')
                    ->trueLabel('Terverifikasi')
                    ->falseLabel('Belum Terverifikasi')
                    ->native(false),
                
                Tables\Filters\Filter::make('rating_filter')
                    ->label('Rating Tinggi')
                    ->query(fn (Builder $query): Builder => $query->where('avg_rating', '>=', 4.0))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('verify')
                        ->label('Verifikasi Terpilih')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_verified' => true]);
                            });
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMitras::route('/'),
            'create' => Pages\CreateMitra::route('/create'),
            'edit' => Pages\EditMitra::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'primary';
    }
}