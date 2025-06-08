<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\ServiceCategory;
use App\Models\JobPost;
 
class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama dengan daftar mitra dan job posts
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil 12 mitra teratas berdasarkan rating
        $mitras = Mitra::orderByDesc('avg_rating')->limit(12)->get();

        // Ambil 10 job posts terbaru
        $jobPosts = JobPost::orderByDesc('created_at')->limit(10)->get();
 
        // Kirim data mitra dan job posts ke view
        return view('customer.homepage', compact('mitras', 'jobPosts'));
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
     * Tampilkan halaman untuk posting pekerjaan baru
     *
     * @return \Illuminate\View\View
     */
    public function postJob()
    {
        // Ambil kategori layanan yang aktif
        $categories = ServiceCategory::where('is_active', true)->get();
 
        // Kirim data kategori ke view
        return view('customer.post_job', compact('categories'));
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
