<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages\ListSettings;  // Import ListSettings Page
use App\Filament\Resources\SettingResource\Pages\CreateSetting;  // Import CreateSetting Page
use App\Filament\Resources\SettingResource\Pages\EditSetting;    // Import EditSetting Page
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('commission_rate')
                    ->label('Commission Rate (%)')
                    ->numeric()
                    ->default(20.00)  // Set default value 20%
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        // Update setting record directly
                        Setting::where('key', 'commission_rate')
                            ->update(['value' => $state]);  // Update value in database
                    }),
            ]);
    }


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('value')->sortable()->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
