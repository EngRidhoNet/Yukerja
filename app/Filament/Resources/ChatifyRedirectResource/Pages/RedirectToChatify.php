<?php

namespace App\Filament\Resources\ChatifyRedirectResource\Pages;

use App\Filament\Resources\ChatifyRedirectResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class RedirectToChatify extends Page
{
    protected static string $resource = ChatifyRedirectResource::class;

    protected static string $view = 'filament.pages.empty';

    public function mount(): mixed
    {
        if (Route::has('chatify')) {
            return redirect()->route('chatify');
        }

        return redirect('/admin')
            ->with('error', 'Chatify route not found.');
    }
}