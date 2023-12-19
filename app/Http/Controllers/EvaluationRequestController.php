<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationRequest;

class EvaluationRequestController extends Controller
{
    public function index()
    {
        $requests = EvaluationRequest::all();
        return view('evaluationRequests.index', compact('requests'));
    }

    public function create()
    {
        return view('evaluationRequests.create');
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'comment' => 'required|string',
    //         'contact_method' => 'required|string',
            
    //     ]);

    //     EvaluationRequest::create([
    //         'user_id' => auth()->id(),
    //         'comment' => $data['comment'],
    //         'contact_method' => $data['contact_method'],
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Request submitted successfully.');
    // }
    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'contact_method' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validation rule for image
        ]);

        // Create an evaluation request instance
        $evaluationRequest = new EvaluationRequest([
            'user_id' => auth()->id(),
            'comment' => $data['comment'],
            'contact_method' => $data['contact_method'],
            // Don't set 'image' here, as it's handled separately below
        ]);

        // Handle the image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = $request->file('image')->store('evaluation_images', 'public');
            $evaluationRequest->image = $imageName;
        } else {
            \Log::info('No image or image is invalid');
        }
        

        $evaluationRequest->save();

        return redirect()->route('dashboard')->with('success', 'Request submitted successfully.');
    }

    public function destroy(Request $request, EvaluationRequest $evaluationRequest)
{
    // Ensure that the user can only delete their own requests
    if (auth()->user()->role !== 'administrator') {
        return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this request.');
    }

    // Delete the associated image file if it exists
    if (!empty($evaluationRequest->image)) {
        // Get the path to the image file in the public folder
        $imagePath = public_path('storage\\' . $evaluationRequest->image);

        // Check if the file exists and delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Now, delete the request
    $evaluationRequest->delete();

    return back()->with('success', 'Request deleted successfully.');
}


    public function approve($id)
    {
        $request = EvaluationRequest::findOrFail($id);
        $request->is_approved = !$request->is_approved;
        $request->save();

        return back()->with('success', 'Request updated successfully.');
    }

    public function dashboard()
{
    $requests = EvaluationRequest::where('is_approved', true)->get();
    return view('dashboard', compact('requests'));
}

    
}
