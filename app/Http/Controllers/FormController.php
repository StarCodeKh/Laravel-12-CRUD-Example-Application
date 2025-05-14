<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Upload;
use Carbon\Carbon;

class FormController extends Controller
{
    /**
     * Display the file upload form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('form.upload');
    }

    /**
     * Handle file upload and save to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFileUpload(Request $request)
    {
        // Validate the uploaded files
        $request->validate([
            'fileupload.*' => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:2048'
        ]);

        try {
            // Check if files are present in the request
            if ($request->hasFile('fileupload')) {
                foreach ($request->file('fileupload') as $file) {
                    // Create a unique filename with timestamp to avoid filename conflicts
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Store the file in the 'uploads' directory within the public disk
                    $path = $file->storeAs('uploads', $filename, 'public');

                    // Save file info to the database
                    Upload::create([
                        'filename'     => $filename,
                        'upload_name'  => Auth::user()->name,
                        'uploaded_at'  => Carbon::now()
                    ]);
                }
            }

            return back()->with('success', 'Files uploaded and saved successfully.');
        } catch (\Exception $e) {
            // Log any exception that occurs during the upload process
            Log::error('File upload failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while uploading the files.');
        }
    }
}