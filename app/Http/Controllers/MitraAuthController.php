<?php

namespace App\Http\Controllers;

use App\Http\Requests\MitraRegisterRequest;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraAuthController extends Controller
{
    public function register(MitraRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'mitra',
        ]);

        $uploadFile = fn($key) => $request->file($key)?->store("mitra/$key", 'public');

        Mitra::create([
            'user_id' => $user->id,
            'business_name' => $validated['business_name'],
            'description' => $validated['description'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'service_category' => $validated['service_category'] ?? null,
            'service_area' => $validated['service_area'] ?? null,
            'identity_card_number' => $validated['identity_card_number'] ?? null,
            'identity_card_photo' => $uploadFile('identity_card_photo'),
            'business_license_number' => $validated['business_license_number'] ?? null,
            'business_license_photo' => $uploadFile('business_license_photo'),
            'profile_photo' => $uploadFile('profile_photo'),
            'cover_photo' => $uploadFile('cover_photo'),
        ]);

        Auth::login($user); // Login user mitra

        return redirect()->route('mitra.dashboard')->with('success', 'Akun Mitra berhasil dibuat!');
    }

}
