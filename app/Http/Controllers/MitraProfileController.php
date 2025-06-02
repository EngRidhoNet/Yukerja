<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mitra;
use App\Models\MitraSkill;
use App\Models\MitraPortfolio;
use Illuminate\Support\Facades\Storage;

class MitraProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $mitra = Mitra::where('user_id', $user->id)->firstOrFail();
        $skills = MitraSkill::where('mitra_id', $mitra->id)->get();
        $portfolios = MitraPortfolio::where('mitra_id', $mitra->id)->get();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->latest()
            ->take(10)
            ->get(); // Adjust based on your Notification model

        return view('mitra.edit-profile', compact('user', 'mitra', 'skills', 'portfolios', 'notifications'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $mitra = Mitra::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'service_category' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'operational_hours' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'skills.*.skill_name' => 'required|string|max:255',
            'skills.*.experience_years' => 'nullable|integer|min:0',
            'skills.*.certification' => 'nullable|string|max:255',
        ]);

        $user->name = $validated['business_name'];
        $user->save();

        if ($request->hasFile('profile_photo')) {
            if ($mitra->profile_photo) {
                Storage::disk('public')->delete($mitra->profile_photo);
            }
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $mitra->profile_photo = $profilePhotoPath;
        }

        if ($request->hasFile('cover_photo')) {
            if ($mitra->cover_photo) {
                Storage::disk('public')->delete($mitra->cover_photo);
            }
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
            $mitra->cover_photo = $coverPhotoPath;
        }

        $mitra->business_name = $validated['business_name'];
        $mitra->description = $validated['description'];
        $mitra->service_category = $validated['service_category'];
        $mitra->phone_number = $validated['phone_number'];
        $mitra->operational_hours = $validated['operational_hours'];
        $mitra->save();

        if (isset($validated['skills'])) {
            MitraSkill::where('mitra_id', $mitra->id)->delete();
            foreach ($validated['skills'] as $skillData) {
                MitraSkill::create([
                    'mitra_id' => $mitra->id,
                    'skill_name' => $skillData['skill_name'],
                    'experience_years' => $skillData['experience_years'],
                    'certification' => $skillData['certification'],
                ]);
            }
        }

        return redirect()->route('mitra.dashboard.edit-profile')->with('success', 'Profile updated successfully');
    }

    public function storePortfolio(Request $request)
    {
        $user = Auth::user();
        $mitra = Mitra::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'completion_date' => 'required|date',
        ]);

        $portfolioData = [
            'mitra_id' => $mitra->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'completion_date' => $validated['completion_date'],
        ];

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('portfolio_images', 'public');
            $portfolioData['image_url'] = $imagePath;
        }

        MitraPortfolio::create($portfolioData);

        return redirect()->route('mitra.dashboard.edit-profile')->with('success', 'Portfolio item added successfully');
    }
}