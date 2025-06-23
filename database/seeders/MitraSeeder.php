<?php

namespace Database\Seeders; // Namespace untuk seeder

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Trait opsional
use Illuminate\Database\Seeder; // Kelas dasar untuk semua seeder
use App\Models\User; // Import model User
use App\Models\Mitra; // Import model Mitra
use App\Models\ServiceCategory; // Import model ServiceCategory
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Support\Str; // Untuk string helper, misalnya membuat string acak

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Ini adalah metode utama yang akan dieksekusi saat seeder dijalankan.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan ada kategori yang sudah dis-seeded
        // Kita akan mengambil semua ID kategori yang sudah ada
        $categoryIds = ServiceCategory::pluck('id')->toArray();

        // Jika belum ada kategori (misal ServiceCategorySeeder belum dijalankan),
        // buat satu kategori dummy sebagai fallback.
        if (empty($categoryIds)) {
            $defaultCategory = ServiceCategory::create([
                'name' => 'Kategori Default',
                'icon' => 'default_icon.png',
                'description' => 'Kategori default yang dibuat oleh MitraSeeder.',
                'is_active' => true,
            ]);
            $categoryIds[] = $defaultCategory->id;
        }

        // Array untuk menyimpan objek User yang ber-role mitra
        $usersMitra = [];

        // Membuat 5 user dummy dengan role 'mitra'
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => 'Mitra User ' . $i,
                'email' => 'mitra' . $i . '@example.com',
                'password' => Hash::make('password'), // Password default: "password"
                'role' => 'mitra', // Set role sebagai mitra
                'profile_photo' => null, // Biarkan null untuk saat ini
                'email_verified_at' => now(), // Anggap email sudah diverifikasi
                'is_active' => true, // Aktifkan user
                'remember_token' => Str::random(10), // Buat remember token acak
            ]);
            $usersMitra[] = $user; // Tambahkan user yang baru dibuat ke array
        }

        // Mengisi data untuk tabel 'mitras' menggunakan user yang baru dibuat
        foreach ($usersMitra as $user) {
            Mitra::create([
                'user_id' => $user->id, // Kaitkan dengan user_id yang sesuai
                'business_name' => 'Bengkel ' . Str::upper(Str::random(5)), // Nama bisnis acak
                'description' => 'Menyediakan jasa perbaikan kendaraan profesional untuk ' . $user->name . '. Berlokasi di Malang.',
                'latitude' => -7.9839 + (mt_rand(-500, 500) / 100000), // Latitude acak di sekitar Malang
                'longitude' => 112.6210 + (mt_rand(-500, 500) / 100000), // Longitude acak di sekitar Malang
                'service_category_id' => $categoryIds[array_rand($categoryIds)], // Pilih kategori secara acak dari yang tersedia
                'service_area' => 'Malang Raya', // Area layanan
                'profile_photo' => null, // Biarkan null
                'cover_photo' => null, // Biarkan null
                'is_verified' => (bool)mt_rand(0, 1), // Acak true/false untuk status verifikasi
                'identity_card_number' => '3573' . Str::random(12, 'numeric'), // Nomor KTP dummy
                'identity_card_photo' => null, // Biarkan null
                'business_license_number' => 'BL-' . Str::upper(Str::random(8)), // Nomor izin bisnis dummy
                'business_license_photo' => null, // Biarkan null
                'avg_rating' => mt_rand(30, 50) / 10, // Rating acak antara 3.0 dan 5.0
                'completed_jobs' => mt_rand(0, 150), // Jumlah pekerjaan selesai acak
            ]);
        }
    }
}