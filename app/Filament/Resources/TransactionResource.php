<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('job_post_id')
                    ->relationship('jobPost', 'title') // Sesuaikan dengan field yang ada di JobPost
                    ->required()
                    ->searchable(),
                    
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name') // Sesuaikan dengan field yang ada di Customer
                    ->required()
                    ->searchable(),
                    
                Forms\Components\Select::make('mitra_id')
                    ->relationship('mitra', 'name') // Sesuaikan dengan field yang ada di Mitra
                    ->required()
                    ->searchable(),
                    
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->inputMode('decimal'),
                    
                Forms\Components\TextInput::make('admin_fee')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->inputMode('decimal'),
                    
                Forms\Components\TextInput::make('mitra_earning')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->inputMode('decimal'),
                    
                Forms\Components\Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->required(),
                    
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'bank_transfer' => 'Bank Transfer',
                        'e_wallet' => 'E-Wallet',
                        'credit_card' => 'Credit Card',
                        'cash' => 'Cash',
                    ]),
                    
                Forms\Components\TextInput::make('invoice_number')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\DateTimePicker::make('payment_date'),
                
                Forms\Components\TextInput::make('transaction_reference')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('jobPost.title') // Sesuaikan dengan field yang ada di JobPost
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('customer.name') // Sesuaikan dengan field yang ada di Customer
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('mitra.name') // Sesuaikan dengan field yang ada di Mitra
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('mitra_earning')
                    ->money('IDR')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'info',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('payment_method'),
                
                Tables\Columns\TextColumn::make('payment_date')
                    ->dateTime()
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
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
                    
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'bank_transfer' => 'Bank Transfer',
                        'e_wallet' => 'E-Wallet',
                        'credit_card' => 'Credit Card',
                        'cash' => 'Cash',
                    ]),
                    
                Tables\Filters\Filter::make('payment_date'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}