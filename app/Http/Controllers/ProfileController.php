<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil user
     */
    public function edit()
    {
        $user = auth()->user();

        // Pastikan relasi many-to-many bernama 'favoritMitra' di model User sudah benar
        $mitraFavorit = $user->favoritMitra()->with('user')->get();

        // Contoh ambil riwayat transaksi user, sesuaikan relasi di User model
        $riwayatTransaksi = $user->transactions()->latest()->limit(10)->get();

        return view('customer.edit_profile', compact('user', 'mitraFavorit', 'riwayatTransaksi'));
    }

    /**
     * Proses update profil user
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            // Tambahkan validasi lain jika perlu
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('customer.edit_profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
