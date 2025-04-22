<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MitraResource\Pages;
use App\Models\Mitra;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class MitraResource extends Resource
{
    protected static ?string $model = Mitra::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Mitra Partners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('business_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Location Information')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('service_area')
                            ->nullable()
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->collapsed(),

                Section::make('Service Information')
                    ->schema([
                        Forms\Components\TextInput::make('service_category')
                            ->nullable()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('avg_rating')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('This is automatically calculated'),
                        Forms\Components\TextInput::make('completed_jobs')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('This is automatically calculated'),
                    ])
                    ->columns(3),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('profile_photo')
                            ->image()
                            ->directory('mitra/profile')
                            ->nullable(),
                        FileUpload::make('cover_photo')
                            ->image()
                            ->directory('mitra/covers')
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->collapsed(),

                Section::make('Verification Information')
                    ->schema([
                        Forms\Components\Toggle::make('is_verified')
                            ->default(false),
                        Forms\Components\TextInput::make('identity_card_number')
                            ->nullable()
                            ->maxLength(255),
                        FileUpload::make('identity_card_photo')
                            ->image()
                            ->directory('mitra/identity_cards')
                            ->nullable(),
                        Forms\Components\TextInput::make('business_license_number')
                            ->nullable()
                            ->maxLength(255),
                        FileUpload::make('business_license_photo')
                            ->image()
                            ->directory('mitra/business_licenses')
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->collapsed(),

                Section::make('Skills')
                    ->schema([
                        Repeater::make('skills')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('skill_name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('experience_years')
                                    ->numeric()
                                    ->nullable(),
                                Forms\Components\TextInput::make('certification')
                                    ->nullable()
                                    ->maxLength(255),
                            ])
                            ->collapsible()
                            ->defaultItems(1)
                            ->columns(3),
                    ])
                    ->collapsed(),

                Section::make('Portfolio')
                    ->schema([
                        Repeater::make('portfolio')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->nullable(),
                                FileUpload::make('image_url')
                                    ->image()
                                    ->directory('mitra/portfolio'),
                                Forms\Components\DatePicker::make('completion_date')
                                    ->nullable(),
                            ])
                            ->collapsible()
                            ->defaultItems(1)
                            ->columns(2),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('User'),
                Tables\Columns\TextColumn::make('business_name')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('service_category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_area')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->circular(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                Tables\Columns\TextColumn::make('avg_rating')
                    ->sortable()
                    ->suffix(' / 5')
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state >= 4.5 => 'success',
                        $state >= 3.0 => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('completed_jobs')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_verified')
                    ->options([
                        '1' => 'Verified',
                        '0' => 'Not Verified',
                    ]),
                Tables\Filters\SelectFilter::make('service_category')
                    ->options(function() {
                        return Mitra::distinct()->pluck('service_category', 'service_category')->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('viewDetails')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Mitra Details')
                    ->modalSubheading(fn ($record) => $record->business_name)
                    ->modalContent(function ($record) {
                        return view('filament.mitra.view-details', ['record' => $record]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('verifySelected')
                        ->label('Verify Selected')
                        ->icon('heroicon-o-check')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_verified' => true]);
                            }
                        })
                        ->requiresConfirmation(),
                ]),
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
            'index' => Pages\ListMitras::route('/'),
            'create' => Pages\CreateMitra::route('/create'),
            'edit' => Pages\EditMitra::route('/{record}/edit'),
        ];
    }
}