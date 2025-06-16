<?php

namespace App\Filament\Resources;

use App\Models\JobPost;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\{TextInput, Textarea, DateTimePicker, Repeater, Select, Card, Grid, Section, Hidden};
use Filament\Forms\Components\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\JobPostResource\Pages;

class JobPostResource extends Resource
{
    protected static ?string $model = JobPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    // protected static ?string $navigationGroup = 'Jobs';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Informasi utama lowongan pekerjaan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('customer_id')
                                    ->relationship('customer', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('service_category_id')
                                    ->relationship('serviceCategory', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ]),

                        TextInput::make('title')
                            ->label('Judul Pekerjaan')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4),

                        TextInput::make('category')
                            ->label('Kategori Tambahan')
                            ->maxLength(255),
                    ]),

                Section::make('Lokasi Pekerjaan')
                    ->description('Detail lokasi pekerjaan akan dilakukan')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(2),

                        View::make('filament.forms.components.map-picker')
                            ->extraAttributes(['class' => 'border rounded-lg mb-4']),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('latitude')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('longitude')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                    ]),

                Section::make('Detail Waktu & Anggaran')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('budget')
                                    ->label('Anggaran (IDR)')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp'),

                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'open' => 'Terbuka',
                                        'assigned' => 'Ditugaskan',
                                        'in_progress' => 'Sedang Berjalan',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ])
                                    ->default('open')
                                    ->disabled(fn ($context) => $context === 'create'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('scheduled_date')
                                    ->label('Tanggal Mulai')
                                    ->required(),

                                DateTimePicker::make('completion_deadline')
                                    ->label('Tenggat Waktu')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Lampiran')
                    ->schema([
                        Repeater::make('attachments')
                            ->relationship('attachments')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('file_name')
                                            ->label('Nama File')
                                            ->required(),

                                        TextInput::make('file_url')
                                            ->label('URL File')
                                            ->required(),

                                        Select::make('file_type')
                                            ->label('Tipe File')
                                            ->options([
                                                'image' => 'Gambar',
                                                'document' => 'Dokumen',
                                                'other' => 'Lainnya',
                                            ])
                                            ->required(),
                                    ]),
                            ])
                            ->label('Lampiran Job')
                            ->createItemButtonLabel('Tambah Lampiran')
                            ->collapsible(),
                    ]),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30)
                    ->sortable(),
                    
                TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('serviceCategory.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('budget')
                    ->label('Anggaran')
                    ->money('IDR')
                    ->sortable(),
                    
                TextColumn::make('scheduled_date')
                    ->label('Tanggal Mulai')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'primary',
                        'assigned' => 'warning',
                        'in_progress' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Terbuka',
                        'assigned' => 'Ditugaskan',
                        'in_progress' => 'Sedang Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),
                    
                Tables\Filters\SelectFilter::make('service_category_id')
                    ->relationship('serviceCategory', 'name')
                    ->label('Kategori Layanan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
                    
                // Action::make('viewApplications')
                //     ->label('Lihat Pelamar')
                //     ->url(fn (JobPost $record) => route('filament.admin.resources.job-applications.index', ['job_post_id' => $record->id]))
                //     ->icon('heroicon-o-user-group')
                //     ->color('success'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobPosts::route('/'),
            'create' => Pages\CreateJobPost::route('/create'),
            'edit' => Pages\EditJobPost::route('/{record}/edit'),
        ];
    }
}