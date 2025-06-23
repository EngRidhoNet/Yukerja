<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

class DashboardCustomerController extends Controller
{
    public function getMitrasByCategory($categoryId)
    {
        try {
            $mitras = Mitra::with(['serviceCategory', 'skills', 'portfolio'])
                ->where('is_verified', true)
                ->where('service_category_id', $categoryId)
                ->orderBy('avg_rating', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $mitras->map(function ($mitra) {
                    return [
                        'id' => $mitra->id,
                        'user_id' => $mitra->user_id,
                        'business_name' => $mitra->business_name,
                        'description' => $mitra->description,
                        'service_area' => $mitra->service_area,
                        'starting_price' => $mitra->starting_price,
                        'avg_rating' => $mitra->avg_rating,
                        'profile_photo' => $mitra->profile_photo,
                        'serviceCategory' => [
                            'id' => $mitra->serviceCategory->id ?? null,
                            'name' => $mitra->serviceCategory->name ?? 'Layanan'
                        ],
                        'skills' => $mitra->skills->map(function ($skill) {
                            return [
                                'skill_name' => $skill->skill_name,
                                'experience_years' => $skill->experience_years
                            ];
                        }),
                        'portfolio' => $mitra->portfolio->map(function ($portfolio) {
                            return [
                                'title' => $portfolio->title,
                                'description' => $portfolio->description,
                                'completion_date' => $portfolio->completion_date
                            ];
                        })
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching mitras: ' . $e->getMessage()
            ], 500);
        }
    }
    public function index()
    {
        $serviceCategories = ServiceCategory::where('is_active', true)->get();
        $mitras = Mitra::with('serviceCategory')
            ->where('is_verified', true)
            ->orderBy('avg_rating', 'desc')
            ->paginate(12);

        return view('customer.dashboard', compact('serviceCategories', 'mitras'));
    }

    public function show($id)
    {
        $mitra = Mitra::with([
            'user',
            'skills',
            'portfolio',
            'reviews' => function ($query) {
                $query->latest()->take(3);
            },
            'reviews.customer.user'
        ])->findOrFail($id);

        // Get service category icon
        $serviceCategory = ServiceCategory::where('name', $mitra->service_category)->first();
        $serviceCategoryIcon = $serviceCategory ? $serviceCategory->icon : 'fas fa-tools';

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $mitra->id,
                'business_name' => $mitra->business_name,
                'description' => $mitra->description,
                'service_category' => $mitra->service_category,
                'service_category_icon' => $serviceCategoryIcon,
                'service_area' => is_array($mitra->service_area) ? implode(', ', $mitra->service_area) : $mitra->service_area,
                'avg_rating' => $mitra->avg_rating ?? 0,
                'skills' => $mitra->skills,
                'portfolio' => $mitra->portfolio,
                'user_id' => $mitra->user_id,
                'starting_price' => $mitra->starting_price ?? 10000,
                'profile_photo' => $mitra->profile_photo ? asset('storage/' . $mitra->profile_photo) : null,
                'reviews' => $mitra->reviews
            ]
        ]);
    }

    public function filterByCategory( $request, $categoryId)
    {
        $category = $categoryId !== 'all' ? ServiceCategory::find($categoryId) : null;

        $mitras = Mitra::with(['user'])
            ->where('is_verified', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('service_category', $category->name);
            })
            ->orderBy('avg_rating', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $mitras->map(function ($mitra) {
                $serviceCategory = ServiceCategory::where('name', $mitra->service_category)->first();
                $serviceCategoryIcon = $serviceCategory ? $serviceCategory->icon : 'fas fa-tools';

                return [
                    'id' => $mitra->id,
                    'business_name' => $mitra->business_name,
                    'service_category' => $mitra->service_category,
                    'service_category_icon' => $serviceCategoryIcon,
                    'avg_rating' => $mitra->avg_rating ?? 0,
                    'service_area' => is_array($mitra->service_area) ? implode(', ', $mitra->service_area) : $mitra->service_area,
                    'description' => $mitra->description,
                    'starting_price' => $mitra->starting_price ?? 10000,
                    'user_id' => $mitra->user_id,
                    'profile_photo' => $mitra->profile_photo ? asset('storage/' . $mitra->profile_photo) : null
                ];
            })
        ]);
    }
}
