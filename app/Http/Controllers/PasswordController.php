<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function change()
    {
        return view('auth.passwords.change'); // Buat view ini nanti
    }
}
