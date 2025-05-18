<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Upload;
use Carbon\Carbon;
use Exception;

class FormController extends Controller
{
    // Display the upload form
    public function index()
    {
        return view('form.upload');
    }

    // Handle file upload
    public function storeFileUpload(Request $request)
    {
        $request->validate([
            'fileupload.*' => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:2048'
        ]);

        try {
            if ($request->hasFile('fileupload')) {
                foreach ($request->file('fileupload') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $filename, 'public');

                    Upload::create([
                        'filename'     => $filename,
                        'upload_name'  => Auth::user()->name,
                        'uploaded_at'  => Carbon::now()
                    ]);
                }
            }

            return back()->with('success', 'Files uploaded and saved successfully.');
        } catch (Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while uploading the files.');
        }
    }

    // Show the file listing view
    public function showFiles()
    {
        $uploads = Upload::all();
        return view('form.fileslisting', compact('uploads'));
    }
    
    public function getData(Request $request)
    {
        $query = Upload::query();
        $total = $query->count();

        $search = $request->get('search')['value'];
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->orWhere('filename', 'like', "%$search%")
                  ->orWhere('upload_name', 'like', "%$search%")
                  ->orWhere('uploaded_at', 'like', "%$search%");
            });
        }

        $filtered = $query->count();
        $records = $query->orderBy(
            $request->get('columns')[$request->get('order')[0]['column']]['data'],
            $request->get('order')[0]['dir']
        )
        ->skip($request->get('start'))
        ->take($request->get('length'))
        ->get();

        $userRole = Auth::user()->role_name;
        $permissions = config('roles')[$userRole] ?? [];

        $data = $records->map(function ($item, $index) use ($request, $permissions) {
            return [
                'action' => in_array('delete', $permissions)
                    ? '<button class="btn btn-danger btn-sm fileDelete" data-filename="'.$item->filename.'"><i class="bi bi-trash"></i></button>'
                    : '',
                'id' => $request->get('start') + $index + 1,
                'filename' => '<a href="'.route('file.download', $item->filename).'" class="filename" data-filename="'.$item->filename.'">'.$item->filename.'</a>',
                'upload_name' => $item->upload_name,
                'uploaded_at' => $item->uploaded_at,
            ];
        });

        return response()->json([
            "draw" => intval($request->get('draw')),
            "iTotalRecords" => $total,
            "iTotalDisplayRecords" => $filtered,
            "aaData" => $data
        ]);
    }

    public function download($filename)
    {
        $path = "uploads/$filename";
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download($path);
    }

    public function destroy(Request $request)
    {
        try {
            $file = Upload::where('filename', $request->filename)->firstOrFail();
            Storage::disk('public')->delete('uploads/' . $file->filename);
            $file->delete();

            return back()->with('success', 'File deleted successfully.');
        } catch (Exception $e) {
            Log::error('Delete error: '.$e->getMessage());
            return back()->with('error', 'Failed to delete file.');
        }
    }

}
