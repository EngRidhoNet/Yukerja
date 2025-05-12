<?php
// app/Http/Controllers/DashboardMitraController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMitraController extends Controller
{
    /**
     * Menampilkan dashboard mitra
     */
    public function index()
    {
        // Data statis untuk dashboard
        $data = [
            'activeJobs' => 8,
            'completedJobs' => 24,
            'rating' => 4.8,
            'violations' => 0,
            'pendingJobs' => [
                [
                    'title' => 'Tambal Ban Setia Sukses',
                    'date' => '12 April 2025',
                    'time' => '13.52'
                ],
                [
                    'title' => 'Tambal Ban Setia Sukses',
                    'date' => '12 April 2025',
                    'time' => '13.52'
                ]
            ]
        ];

        return view('mitra.dashboard', $data);
    }

    
}
?>