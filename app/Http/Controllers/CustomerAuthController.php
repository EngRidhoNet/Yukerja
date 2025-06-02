<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRegisterRequest;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function register(CustomerRegisterRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
        ]);

        $ktpPath = $request->file('identity_card_photo')?->store('ktp_customers', 'public');

        Customer::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'identity_card_number' => $validated['identity_card_number'] ?? null,
            'identity_card_photo' => $ktpPath,
        ]);

        Auth::login($user); // Login user yang baru dibuat

        return redirect()->route('customer.dashboard')->with('success', 'Registrasi berhasil!');
    }
}
