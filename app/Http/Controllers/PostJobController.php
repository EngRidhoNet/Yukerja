<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;

class PostJobController extends Controller
{
    // Display a listing of the job posts
    public function index()
    {
        $jobPosts = JobPost::all();
        return view('jobs.index', compact('jobPosts'));
    }

    // Show the form for creating a new job post
    public function create()
    {
        return view('jobs.create');
    }

    // Store a newly created job post in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric',
            'scheduled_date' => 'nullable|date',
            'completion_deadline' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'cancellation_reason' => 'nullable|string|max:255',
        ]);

        $validated['customer_id'] = auth()->id();

        // Set default values for scheduled_date and completion_deadline if null
        if (empty($validated['scheduled_date'])) {
            $validated['scheduled_date'] = now();
        }
        if (empty($validated['completion_deadline'])) {
            $validated['completion_deadline'] = now()->addDays(7);
        }

        JobPost::create($validated);

        return redirect()->route('customer.post_job')->with('success', 'Job post created successfully.');
    }

    // Display the specified job post
    public function show($id)
    {
        $jobPost = JobPost::findOrFail($id);
        return view('jobs.show', compact('jobPost'));
    }

    // Show the form for editing the specified job post
    public function edit($id)
    {
        $jobPost = JobPost::findOrFail($id);
        return view('jobs.edit', compact('jobPost'));
    }

    // Update the specified job post in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric',
            'scheduled_date' => 'nullable|date',
            'completion_deadline' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'cancellation_reason' => 'nullable|string|max:255',
        ]);

        $jobPost = JobPost::findOrFail($id);
        $jobPost->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job post updated successfully.');
    }

    // Remove the specified job post from storage
    public function destroy($id)
    {
        $jobPost = JobPost::findOrFail($id);
        $jobPost->delete();

        return redirect()->route('jobs.index')->with('success', 'Job post deleted successfully.');
    }
}
