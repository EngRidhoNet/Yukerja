<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        // Fetch all mitras with their skills and portfolio
        $mitras = Mitra::with(['skills', 'portfolio'])->get();
        return view('customer.dashboard', compact('mitras'));
    }

    public function show($id)
    {
        // Fetch a single mitra with their skills and portfolio
        $mitra = Mitra::with(['skills', 'portfolio'])->findOrFail($id);
        return response()->json($mitra);
    }
}
