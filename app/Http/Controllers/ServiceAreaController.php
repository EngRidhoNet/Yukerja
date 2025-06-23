<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Mitra;

class ServiceAreaController extends Controller
{
    public function index()
    {
        $mitra = Auth::user();
        $serviceAreas = $mitra->service_areas ? json_decode($mitra->service_areas, true) : [];
        return view('mitra.area', compact('serviceAreas'));
    }

    public function getProvinces(): JsonResponse
    {
        try {
            // Data provinsi hanya untuk Jawa
            $javaProvinces = [
                ['id' => '31', 'name' => 'DKI Jakarta'],
                ['id' => '32', 'name' => 'Jawa Barat'],
                ['id' => '33', 'name' => 'Jawa Tengah'],
                ['id' => '34', 'name' => 'DI Yogyakarta'],
                ['id' => '35', 'name' => 'Jawa Timur'],
                ['id' => '36', 'name' => 'Banten']
            ];

            return response()->json([
                'success' => true,
                'data' => $javaProvinces
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data provinsi'
            ], 500);
        }
    }

    public function getCities($provinceId): JsonResponse
    {
        try {
            // Data kota/kabupaten untuk provinsi di Jawa
            $javaCities = [
                '31' => [ // DKI Jakarta
                    ['id' => '3171', 'name' => 'Kota Jakarta Pusat'],
                    ['id' => '3172', 'name' => 'Kota Jakarta Utara'],
                    ['id' => '3173', 'name' => 'Kota Jakarta Barat'],
                    ['id' => '3174', 'name' => 'Kota Jakarta Selatan'],
                    ['id' => '3175', 'name' => 'Kota Jakarta Timur'],
                    ['id' => '3101', 'name' => 'Kabupaten Kepulauan Seribu']
                ],
                '32' => [ // Jawa Barat
                    ['id' => '3201', 'name' => 'Kabupaten Bogor'],
                    ['id' => '3202', 'name' => 'Kabupaten Sukabumi'],
                    ['id' => '3203', 'name' => 'Kabupaten Cianjur'],
                    ['id' => '3204', 'name' => 'Kabupaten Bandung'],
                    ['id' => '3205', 'name' => 'Kabupaten Garut'],
                    ['id' => '3206', 'name' => 'Kabupaten Tasikmalaya'],
                    ['id' => '3207', 'name' => 'Kabupaten Ciamis'],
                    ['id' => '3208', 'name' => 'Kabupaten Kuningan'],
                    ['id' => '3209', 'name' => 'Kabupaten Cirebon'],
                    ['id' => '3210', 'name' => 'Kabupaten Majalengka'],
                    ['id' => '3211', 'name' => 'Kabupaten Sumedang'],
                    ['id' => '3212', 'name' => 'Kabupaten Indramayu'],
                    ['id' => '3213', 'name' => 'Kabupaten Subang'],
                    ['id' => '3214', 'name' => 'Kabupaten Purwakarta'],
                    ['id' => '3215', 'name' => 'Kabupaten Karawang'],
                    ['id' => '3216', 'name' => 'Kabupaten Bekasi'],
                    ['id' => '3217', 'name' => 'Kabupaten Bandung Barat'],
                    ['id' => '3218', 'name' => 'Kabupaten Pangandaran'],
                    ['id' => '3271', 'name' => 'Kota Bogor'],
                    ['id' => '3272', 'name' => 'Kota Sukabumi'],
                    ['id' => '3273', 'name' => 'Kota Bandung'],
                    ['id' => '3274', 'name' => 'Kota Cirebon'],
                    ['id' => '3275', 'name' => 'Kota Bekasi'],
                    ['id' => '3276', 'name' => 'Kota Depok'],
                    ['id' => '3277', 'name' => 'Kota Cimahi'],
                    ['id' => '3278', 'name' => 'Kota Tasikmalaya'],
                    ['id' => '3279', 'name' => 'Kota Banjar']
                ],
                '33' => [ // Jawa Tengah
                    ['id' => '3301', 'name' => 'Kabupaten Cilacap'],
                    ['id' => '3302', 'name' => 'Kabupaten Banyumas'],
                    ['id' => '3303', 'name' => 'Kabupaten Purbalingga'],
                    ['id' => '3304', 'name' => 'Kabupaten Banjarnegara'],
                    ['id' => '3305', 'name' => 'Kabupaten Kebumen'],
                    ['id' => '3306', 'name' => 'Kabupaten Purworejo'],
                    ['id' => '3307', 'name' => 'Kabupaten Wonosobo'],
                    ['id' => '3308', 'name' => 'Kabupaten Magelang'],
                    ['id' => '3309', 'name' => 'Kabupaten Boyolali'],
                    ['id' => '3310', 'name' => 'Kabupaten Klaten'],
                    ['id' => '3311', 'name' => 'Kabupaten Sukoharjo'],
                    ['id' => '3312', 'name' => 'Kabupaten Wonogiri'],
                    ['id' => '3313', 'name' => 'Kabupaten Karanganyar'],
                    ['id' => '3314', 'name' => 'Kabupaten Sragen'],
                    ['id' => '3315', 'name' => 'Kabupaten Grobogan'],
                    ['id' => '3316', 'name' => 'Kabupaten Blora'],
                    ['id' => '3317', 'name' => 'Kabupaten Rembang'],
                    ['id' => '3318', 'name' => 'Kabupaten Pati'],
                    ['id' => '3319', 'name' => 'Kabupaten Kudus'],
                    ['id' => '3320', 'name' => 'Kabupaten Jepara'],
                    ['id' => '3321', 'name' => 'Kabupaten Demak'],
                    ['id' => '3322', 'name' => 'Kabupaten Semarang'],
                    ['id' => '3323', 'name' => 'Kabupaten Temanggung'],
                    ['id' => '3324', 'name' => 'Kabupaten Kendal'],
                    ['id' => '3325', 'name' => 'Kabupaten Batang'],
                    ['id' => '3326', 'name' => 'Kabupaten Pekalongan'],
                    ['id' => '3327', 'name' => 'Kabupaten Pemalang'],
                    ['id' => '3328', 'name' => 'Kabupaten Tegal'],
                    ['id' => '3329', 'name' => 'Kabupaten Brebes'],
                    ['id' => '3371', 'name' => 'Kota Magelang'],
                    ['id' => '3372', 'name' => 'Kota Surakarta'],
                    ['id' => '3373', 'name' => 'Kota Salatiga'],
                    ['id' => '3374', 'name' => 'Kota Semarang'],
                    ['id' => '3375', 'name' => 'Kota Pekalongan'],
                    ['id' => '3376', 'name' => 'Kota Tegal']
                ],
                '34' => [ // DI Yogyakarta
                    ['id' => '3401', 'name' => 'Kabupaten Kulon Progo'],
                    ['id' => '3402', 'name' => 'Kabupaten Bantul'],
                    ['id' => '3403', 'name' => 'Kabupaten Gunungkidul'],
                    ['id' => '3404', 'name' => 'Kabupaten Sleman'],
                    ['id' => '3471', 'name' => 'Kota Yogyakarta']
                ],
                '35' => [ // Jawa Timur
                    ['id' => '3501', 'name' => 'Kabupaten Pacitan'],
                    ['id' => '3502', 'name' => 'Kabupaten Ponorogo'],
                    ['id' => '3503', 'name' => 'Kabupaten Trenggalek'],
                    ['id' => '3504', 'name' => 'Kabupaten Tulungagung'],
                    ['id' => '3505', 'name' => 'Kabupaten Blitar'],
                    ['id' => '3506', 'name' => 'Kabupaten Kediri'],
                    ['id' => '3507', 'name' => 'Kabupaten Malang'],
                    ['id' => '3508', 'name' => 'Kabupaten Lumajang'],
                    ['id' => '3509', 'name' => 'Kabupaten Jember'],
                    ['id' => '3510', 'name' => 'Kabupaten Banyuwangi'],
                    ['id' => '3511', 'name' => 'Kabupaten Bondowoso'],
                    ['id' => '3512', 'name' => 'Kabupaten Situbondo'],
                    ['id' => '3513', 'name' => 'Kabupaten Probolinggo'],
                    ['id' => '3514', 'name' => 'Kabupaten Pasuruan'],
                    ['id' => '3515', 'name' => 'Kabupaten Sidoarjo'],
                    ['id' => '3516', 'name' => 'Kabupaten Mojokerto'],
                    ['id' => '3517', 'name' => 'Kabupaten Jombang'],
                    ['id' => '3518', 'name' => 'Kabupaten Nganjuk'],
                    ['id' => '3519', 'name' => 'Kabupaten Madiun'],
                    ['id' => '3520', 'name' => 'Kabupaten Magetan'],
                    ['id' => '3521', 'name' => 'Kabupaten Ngawi'],
                    ['id' => '3522', 'name' => 'Kabupaten Bojonegoro'],
                    ['id' => '3523', 'name' => 'Kabupaten Tuban'],
                    ['id' => '3524', 'name' => 'Kabupaten Lamongan'],
                    ['id' => '3525', 'name' => 'Kabupaten Gresik'],
                    ['id' => '3526', 'name' => 'Kabupaten Bangkalan'],
                    ['id' => '3527', 'name' => 'Kabupaten Sampang'],
                    ['id' => '3528', 'name' => 'Kabupaten Pamekasan'],
                    ['id' => '3529', 'name' => 'Kabupaten Sumenep'],
                    ['id' => '3571', 'name' => 'Kota Kediri'],
                    ['id' => '3572', 'name' => 'Kota Blitar'],
                    ['id' => '3573', 'name' => 'Kota Malang'],
                    ['id' => '3574', 'name' => 'Kota Probolinggo'],
                    ['id' => '3575', 'name' => 'Kota Pasuruan'],
                    ['id' => '3576', 'name' => 'Kota Mojokerto'],
                    ['id' => '3577', 'name' => 'Kota Madiun'],
                    ['id' => '3578', 'name' => 'Kota Surabaya'],
                    ['id' => '3579', 'name' => 'Kota Batu']
                ],
                '36' => [ // Banten
                    ['id' => '3601', 'name' => 'Kabupaten Pandeglang'],
                    ['id' => '3602', 'name' => 'Kabupaten Lebak'],
                    ['id' => '3603', 'name' => 'Kabupaten Tangerang'],
                    ['id' => '3604', 'name' => 'Kabupaten Serang'],
                    ['id' => '3671', 'name' => 'Kota Tangerang'],
                    ['id' => '3672', 'name' => 'Kota Cilegon'],
                    ['id' => '3673', 'name' => 'Kota Serang'],
                    ['id' => '3674', 'name' => 'Kota Tangerang Selatan']
                ]
            ];

            $cities = $javaCities[$provinceId] ?? [];

            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kota'
            ], 500);
        }
    }

    public function getDistricts($cityId): JsonResponse
    {
        try {
            // Sample districts for major cities
            $sampleDistricts = [
                // Jakarta Pusat
                '3171' => [
                    ['id' => '317101', 'name' => 'Gambir'],
                    ['id' => '317102', 'name' => 'Sawah Besar'],
                    ['id' => '317103', 'name' => 'Kemayoran'],
                    ['id' => '317104', 'name' => 'Senen'],
                    ['id' => '317105', 'name' => 'Cempaka Putih'],
                    ['id' => '317106', 'name' => 'Menteng'],
                    ['id' => '317107', 'name' => 'Tanah Abang'],
                    ['id' => '317108', 'name' => 'Johar Baru']
                ],
                // Jakarta Selatan
                '3174' => [
                    ['id' => '317401', 'name' => 'Kebayoran Baru'],
                    ['id' => '317402', 'name' => 'Kebayoran Lama'],
                    ['id' => '317403', 'name' => 'Pesanggrahan'],
                    ['id' => '317404', 'name' => 'Cilandak'],
                    ['id' => '317405', 'name' => 'Pasar Minggu'],
                    ['id' => '317406', 'name' => 'Jagakarsa'],
                    ['id' => '317407', 'name' => 'Mampang Prapatan'],
                    ['id' => '317408', 'name' => 'Pancoran'],
                    ['id' => '317409', 'name' => 'Tebet'],
                    ['id' => '317410', 'name' => 'Setia Budi']
                ],
                // Bandung
                '3273' => [
                    ['id' => '327301', 'name' => 'Sukasari'],
                    ['id' => '327302', 'name' => 'Coblong'],
                    ['id' => '327303', 'name' => 'Andir'],
                    ['id' => '327304', 'name' => 'Cicendo'],
                    ['id' => '327305', 'name' => 'Bojongloa Kaler'],
                    ['id' => '327306', 'name' => 'Astana Anyar'],
                    ['id' => '327307', 'name' => 'Regol'],
                    ['id' => '327308', 'name' => 'Lengkong'],
                    ['id' => '327309', 'name' => 'Bandung Kulon'],
                    ['id' => '327310', 'name' => 'Bojongloa Kidul'],
                    ['id' => '327311', 'name' => 'Batununggal'],
                    ['id' => '327312', 'name' => 'Kiaracondong'],
                    ['id' => '327313', 'name' => 'Sumur Bandung'],
                    ['id' => '327314', 'name' => 'Bandung Wetan'],
                    ['id' => '327315', 'name' => 'Cibeunying Kaler'],
                    ['id' => '327316', 'name' => 'Cibeunying Kidul']
                ],
                // Surabaya
                '3578' => [
                    ['id' => '357801', 'name' => 'Simokerto'],
                    ['id' => '357802', 'name' => 'Semampir'],
                    ['id' => '357803', 'name' => 'Pabean Cantikan'],
                    ['id' => '357804', 'name' => 'Bubutan'],
                    ['id' => '357805', 'name' => 'Krembangan'],
                    ['id' => '357806', 'name' => 'Tandes'],
                    ['id' => '357807', 'name' => 'Asemrowo'],
                    ['id' => '357808', 'name' => 'Benowo'],
                    ['id' => '357809', 'name' => 'Lakarsantri'],
                    ['id' => '357810', 'name' => 'Sambikerep']
                ]
            ];

            // Generate default districts for other cities
            $districts = $sampleDistricts[$cityId] ?? [
                ['id' => $cityId . '01', 'name' => 'Kecamatan 1'],
                ['id' => $cityId . '02', 'name' => 'Kecamatan 2'],
                ['id' => $cityId . '03', 'name' => 'Kecamatan 3'],
                ['id' => $cityId . '04', 'name' => 'Kecamatan 4'],
                ['id' => $cityId . '05', 'name' => 'Kecamatan 5']
            ];

            return response()->json([
                'success' => true,
                'data' => $districts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kecamatan'
            ], 500);
        }
    }

    public function updateLocation(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        try {
            $mitra = Auth::user();
            $mitra->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lokasi berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui lokasi'
            ], 500);
        }
    }

    public function saveServiceAreas(Request $request): JsonResponse
    {
        $request->validate([
            'service_areas' => 'required|array',
            'service_areas.*.province_id' => 'required|string',
            'service_areas.*.city_id' => 'required|string',
            'service_areas.*.district_id' => 'required|string',
            'service_areas.*.province_name' => 'required|string',
            'service_areas.*.city_name' => 'required|string',
            'service_areas.*.district_name' => 'required|string'
        ]);

        try {
            $mitra = Auth::user();
            
            $mitra->update([
                'service_areas' => json_encode($request->service_areas)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Area layanan berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan area layanan'
            ], 500);
        }
    }

    public function searchLocation(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        try {
            $response = Http::get('https://nominatim.openstreetmap.org/search', [
                'q' => $request->query . ', Jawa',
                'format' => 'json',
                'limit' => 5,
                'countrycodes' => 'id',
                'accept-language' => 'id',
                'bounded' => 1,
                'viewbox' => '105.0,-8.5,115.0,-5.5' // Bounding box untuk Jawa
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari lokasi'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari lokasi'
            ], 500);
        }
    }
}