<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->schema([
                        // Forms\Components\Select::make('user_id')
                        //     ->relationship('user', 'name')
                        //     ->required()
                        //     ->searchable(),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->nullable()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Address Information')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->nullable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->collapsible(),

                Section::make('Loyalty & Verification')
                    ->schema([
                        Forms\Components\TextInput::make('loyalty_points')
                            ->numeric()
                            ->default(0)
                            ->helperText('Customer loyalty points'),
                        Forms\Components\TextInput::make('identity_card_number')
                            ->nullable()
                            ->maxLength(255),
                        FileUpload::make('identity_card_photo')
                            ->image()
                            ->directory('customers/identity_cards')
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('loyalty_points')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state >= 1000 => 'success',
                        $state >= 500 => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\ImageColumn::make('identity_card_photo')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('identity_card_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\Filter::make('high_loyalty')
                    ->query(fn (Builder $query): Builder => $query->where('loyalty_points', '>=', 500))
                    ->label('High Loyalty (500+)'),
                Tables\Filters\Filter::make('has_id_card')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('identity_card_number'))
                    ->label('Has ID Card'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('addLoyaltyPoints')
                        ->label('Add Loyalty Points')
                        ->icon('heroicon-o-star')
                        ->form([
                            Forms\Components\TextInput::make('points')
                                ->label('Points to Add')
                                ->numeric()
                                ->required()
                                ->minValue(1)
                                ->default(10),
                        ])
                        ->action(function ($records, array $data) {
                            foreach ($records as $record) {
                                $record->update([
                                    'loyalty_points' => $record->loyalty_points + $data['points'],
                                ]);
                            }
                        }),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}