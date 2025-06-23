<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatifyRedirectResource\Pages\RedirectToChatify;
use Filament\Resources\Resource;

class ChatifyRedirectResource extends Resource
{
    protected static ?string $model = null;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Chat';

    public static function getPages(): array
    {
        return [
            'index' => RedirectToChatify::route('/'),
        ];
    }

    public static function getRoutePrefix(): string
    {
        return 'chat-redirect';
    }
}