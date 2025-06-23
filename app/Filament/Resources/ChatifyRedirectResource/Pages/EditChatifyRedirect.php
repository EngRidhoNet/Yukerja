<?php

namespace App\Filament\Resources\ChatifyRedirectResource\Pages;

use App\Filament\Resources\ChatifyRedirectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChatifyRedirect extends EditRecord
{
    protected static string $resource = ChatifyRedirectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
