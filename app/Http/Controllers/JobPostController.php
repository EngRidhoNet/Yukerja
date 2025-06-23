<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\JobPost;
use App\Models\JobAttachment;
use App\Models\ServiceCategory;
use App\Models\Customer;

class JobPostController extends Controller
{
    public function create()
    {
        $categories = ServiceCategory::all();
        return view('customer.post_job', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_category_id' => 'required|exists:service_categories,id',
            'location' => 'required|string',
            'location_name' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'date' => 'required|date|after_or_equal:today',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ], [
            'date.after_or_equal' => 'Tanggal harus hari ini atau setelahnya.',
            'files.*.max' => 'Setiap file tidak boleh lebih besar dari 10MB.',
            'files.*.mimes' => 'Hanya file JPG, PNG, PDF, DOC, dan DOCX yang diperbolehkan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        try {
            // Dapatkan customer yang terkait dengan user yang login
            $customer = Customer::where('user_id', Auth::id())->first();

            if (!$customer) {
                return response()->json([
                    'errors' => ['auth' => ['Anda harus melengkapi profil customer terlebih dahulu']],
                    'message' => 'Profil customer diperlukan'
                ], 422);
            }

            // Parse lokasi koordinat
            $locationParts = array_map('trim', explode(',', $request->location));
            $latitude = $locationParts[0] ?? null;
            $longitude = $locationParts[1] ?? null;

            if (!is_numeric($latitude) || !is_numeric($longitude)) {
                return response()->json([
                    'errors' => ['location' => ['Format koordinat lokasi tidak valid']],
                    'message' => 'Format lokasi tidak valid'
                ], 422);
            }

            // Buat job post
            $jobPost = JobPost::create([
                'customer_id' => $customer->id, // Gunakan ID customer bukan user ID
                'service_category_id' => $request->service_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'latitude' => (float) $latitude,
                'longitude' => (float) $longitude,
                'address' => $request->location_name,
                'budget' => $request->budget,
                'scheduled_date' => $request->date,
                'status' => 'open',
            ]);

            // Handle upload file
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('public/attachments/job-' . $jobPost->id);
                    
                    JobAttachment::create([
                        'job_post_id' => $jobPost->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_url' => Storage::url($path),
                        'file_type' => $file->getClientMimeType(),
                    ]);
                }
            }

            return response()->json([
                'message' => 'Job berhasil diposting!',
                'redirect_url' => route('customer.dashboard')
            ], 201);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Job Post Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan saat memposting job. Silakan coba lagi atau hubungi support.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}