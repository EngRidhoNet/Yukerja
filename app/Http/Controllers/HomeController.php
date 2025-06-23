<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with service listings
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hardcoded service providers data
        $serviceProviders = $this->getDummyServiceProviders();

        return view('customer.dashboard', [
            'serviceProviders' => $serviceProviders
        ]);
    }

    /**
     * Display services by category
     *
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function category($category)
    {
        // Hardcoded service providers data
        $serviceProviders = $this->getDummyServiceProviders();
        
        // Convert route name to display name
        $displayCategory = str_replace('-', ' ', $category);
        
        return view('customer.category', [
            'category' => $displayCategory,
            'serviceProviders' => $serviceProviders
        ]);
    }
    
    /**
     * Generate dummy service providers data
     * 
     * @return array
     */
    private function getDummyServiceProviders()
    {
        $providers = [];
        
        // Generate 15 providers with random data
        for ($i = 0; $i < 15; $i++) {
            $providers[] = [
                'id' => $i + 1,
                'name' => 'Tambal Ban Setia Sukses',
                'rating' => number_format(rand(45, 50) / 10, 1),
                'distance' => number_format(rand(1, 15) / 10, 1) . ' km',
                'price' => 'Rp 25.000',
            ];
        }
        
        return $providers;
    }
}