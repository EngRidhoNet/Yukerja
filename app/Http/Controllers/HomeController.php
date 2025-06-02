<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama dengan daftar mitra
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil 12 mitra teratas berdasarkan rating
        $mitras = Mitra::orderByDesc('avg_rating')->limit(12)->get();

        // Kirim data mitra ke view
        return view('customer.homepage', compact('mitras'));
    }

    /**
     * Tampilkan mitra berdasarkan kategori layanan
     *
     * @param string $categorySlug
     * @return \Illuminate\View\View
     */
    public function category($categorySlug)
    {
        // Ambil mitra berdasarkan kategori service_category
        $mitras = Mitra::where('service_category', $categorySlug)
            ->orderByDesc('avg_rating')
            ->get();

        // Format kategori untuk tampilan
        $displayCategory = str_replace('-', ' ', $categorySlug);

        return view('customer.category', [
            'category' => $displayCategory,
            'mitras' => $mitras
        ]);
    }

    /**
     * Detail layanan (bila ada)
     */
    public function serviceDetail($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('customer.service_detail', compact('mitra'));
    }

     public function editProfile()
    {
        $user = auth()->user();

        // Ambil mitra favorit user
        $mitras = $user->favoritMitra()->get();

        // Ambil 10 transaksi terbaru user
        $riwayatTransaksi = $user->transactions()->latest()->limit(10)->get();

        return view('customer.edit_profile', compact('user', 'mitras', 'riwayatTransaksi'));
    }

}
