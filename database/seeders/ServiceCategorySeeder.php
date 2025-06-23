<?php

namespace Database\Seeders; // Namespace untuk seeder

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Trait opsional untuk mencegah event model terpicu
use Illuminate\Database\Seeder; // Kelas dasar untuk semua seeder
use App\Models\ServiceCategory; // Import model ServiceCategory agar bisa digunakan

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Ini adalah metode utama yang akan dieksekusi saat seeder dijalankan.
     *
     * @return void
     */
    public function run()
    {
        // Definisikan data kategori yang ingin dimasukkan
        $categories = [
            ['name' => 'Perbaikan Elektronik', 'icon' => 'icon_elektronik.png', 'description' => 'Servis dan perbaikan berbagai perangkat elektronik.'],
            ['name' => 'Perbaikan Kendaraan', 'icon' => 'icon_kendaraan.png', 'description' => 'Servis dan perbaikan kendaraan roda dua dan empat.'],
            ['name' => 'Jasa Kebersihan', 'icon' => 'icon_kebersihan.png', 'description' => 'Layanan kebersihan rumah, kantor, atau area komersial.'],
            ['name' => 'Pijat & Spa', 'icon' => 'icon_pijat.png', 'description' => 'Layanan pijat dan relaksasi profesional.'],
            ['name' => 'Jasa Konstruksi', 'icon' => 'icon_konstruksi.png', 'description' => 'Pembangunan, renovasi, dan perbaikan bangunan.'],
            ['name' => 'Jasa Taman', 'icon' => 'icon_taman.png', 'description' => 'Penataan dan perawatan taman.'],
            ['name' => 'Fotografi', 'icon' => 'icon_fotografi.png', 'description' => 'Jasa fotografi untuk berbagai acara.'],
        ];

        // Loop melalui array kategori dan masukkan setiap kategori ke dalam database
        foreach ($categories as $category) {
            ServiceCategory::create($category); // Menggunakan Eloquent untuk membuat record baru
        }
    }
}