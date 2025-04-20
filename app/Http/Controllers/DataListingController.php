<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DB;

class DataListingController extends Controller
{
    function index()
    {
        return view('data-listing.listing');
    }

    // Fetch data for the DataTable
    public function getData(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowPerPage = $request->get('length');
        $order = $request->get('order');
        $columns = $request->get('columns');
        $search = $request->get('search');
        
        if (isset($order[0]['column']) && isset($columns[$order[0]['column']]['data'])) {
            $columnIndex = $order[0]['column'];
            $columnName = $columns[$columnIndex]['data'];
            $columnSortOrder = $order[0]['dir'] ?? 'asc';
        } else {
            // Set default sorting parameters
            $columnName = 'id'; // Replace with your default column
            $columnSortOrder = 'asc';
        }
        $searchValue = $search['value'] ?? '';

        // Base query for users
        $users = DB::table('users');

        // Count total records without filtering
        $totalRecords = $users->count();

        // Define searchable columns
        $searchColumns = [
            'name',
            'user_id',
            'email',
            'position',
            'phone_number',
            'join_date',
            'role_name',
            'status',
            'department'
        ];

        // Count total records with filtering
        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue, $searchColumns) {
            foreach ($searchColumns as $column) {
                $query->orWhere($column, 'like', "%{$searchValue}%");
            }
        })->count();

        // Fetch filtered records with sorting and pagination
        $records = $users->where(function ($query) use ($searchValue, $searchColumns) {
            foreach ($searchColumns as $column) {
                $query->orWhere($column, 'like', "%{$searchValue}%");
            }
        })
        ->orderBy($columnName, $columnSortOrder)
        ->skip($start)
        ->take($rowPerPage)
        ->get();

        // Badge class mapping for status
        $badgeClasses = [
            'Active'    => 'bg-success-subtle text-success',
            'Inactive'  => 'bg-danger-subtle text-danger',
            'Pending'   => 'bg-primary-subtle text-primary',
            'Suspended' => 'bg-warning-subtle text-warning',
        ];

        // Get the current user's role
        $userRole = Auth::user()->role_name;
        // Get the permissions based on the user's role
        $permissions = config('roles')[$userRole] ?? [];

        $data_arr = [];

        foreach ($records as $key => $record) {
            $last_login = Carbon::parse($record->last_login)->diffForHumans();

            $action = '<div class="d-flex gap-2">';

            // View permission: All roles can view
            if (in_array('view', $permissions)) {
                $action .= '
                    <button class="btn btn-info btn-sm userView" data-id="'.$record->id.'" data-bs-toggle="offcanvas" data-bs-target="#viewUser" aria-controls="viewUser">
                        <i class="bi bi-eye"></i>
                    </button>';
            }

            // Edit permission: Admin & Editor roles can edit
            if (in_array('edit', $permissions)) {
                $action .= '
                    <button class="btn btn-warning btn-sm userUpdate" data-id="'.$record->id.'" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                        <i class="bi bi-pencil"></i>
                    </button>';
            }

            // Delete permission: Only Admin can delete
            if (in_array('delete', $permissions)) {
                $action .= '
                    <button class="btn btn-danger btn-sm userDelete" data-id="'.$record->id.'" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">
                        <i class="bi bi-trash"></i>
                    </button>';
            }

            $action .= '</div>';

            $fullName = $record->name;
            $parts = explode(' ', $fullName);
            $initials = '';
            foreach ($parts as $part) {
                $initials .= strtoupper(substr($part, 0, 1));
            }

            if (!empty($record->avatar)) {
                $nameAvatar = '<div class="d-flex align-items-center rounded">
                    <img src="'.url('/assets/images/'.$record->avatar).'" alt="Profile" data-image-circle="'.$record->avatar.'" class="rounded-circle me-2 image-circle">
                    <span class="fw-medium name">'.$record->name.'</span>
                </div>';
            } else {
                $nameAvatar = '<div class="d-flex">
                    <span class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle fw-bold small image-circle me-2">
                        '.$initials.'
                    </span>
                    <span class="fw-medium name">'.$record->name.'</span>
                </div>';
            }

            $name = '';

            $statusText = $record->status;
            $badgeClass = $badgeClasses[$statusText] ?? 'bg-secondary-subtle text-secondary';
            $status     = "<span class=\"badge {$badgeClass} status\">{$statusText}</span>";

            $data_arr[] = [
                "action"       => $action,
                "id"           => '<span class="id" data-id="'.$record->id.'">'.($start + $key + 1).'</span>',
                "name"         => '<span>'.$nameAvatar.'</span>',
                "user_id"      => '<span class="user_id">'.$record->user_id.'</span>',
                "email"        => '<span class="email">'.$record->email.'</span>',
                "position"     => '<span class="position">'.$record->position.'</span>',
                "phone_number" => '<span class="phone_number">'.$record->phone_number.'</span>',
                "join_date"    => $record->join_date,
                "last_login"   => $last_login,
                "role_name"    => '<span class="role_name">'.$record->role_name.'</span>',
                "department"   => '<span class="department">'.$record->department.'</span>',
                "status"       => $status,
            ];
        }

        // Prepare response in DataTables format
        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];

        return response()->json($response);
    }

    // Update user record
    public function updateRecord(Request $request)
    {
        // Begin a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Retrieve data from the request
            $user_id      = $request->user_id;
            $name         = $request->name;
            $email        = $request->email;
            $role_name    = $request->role_name;
            $position     = $request->position;
            $phone_number = $request->phone_number;
            $department   = $request->department;
            $status       = $request->status;
            $image_name   = $request->hidden_image;  // Current image name from hidden input

            // Prepare the current date for logging (optional, can be added to the update)
            $todayDate = Carbon::now()->toDayDateTimeString();

            // Check if a new profile image is uploaded
            $image = $request->file('profile_image');
            if ($image) {
                // Delete the old image if it exists
                if ($image_name && file_exists(public_path('assets/images/'.$image_name))) {
                    unlink(public_path('assets/images/'.$image_name));
                }

                // Generate a new image name and move the file to the public directory
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $image_name);
            }
            // If no new image is uploaded, keep the existing image name
            $update = [
                'name'          => $name,
                'email'         => $email,
                'role_name'     => $role_name,
                'position'      => $position,
                'phone_number'  => $phone_number,
                'department'    => $department,
                'status'        => $status,
                'avatar'        => $image_name,  // Save the new or existing image name
            ];

            User::where('user_id', $user_id)->update($update);
            DB::commit();
            return redirect()->back()->with('success', 'User updated successfully :)');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('User update failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'User update failed. Please try again.');
        }
    }

    public function deleteRecord(Request $request)
    {
        // Start the transaction to make it atomic
        DB::beginTransaction();

        try {
            // Get the user ID and avatar from the request
            $userId = $request->user_id;
            $avatar = $request->avatar;

            // Find the user by ID, throw an exception if not found
            $user = User::where('user_id', $userId)->firstOrFail();

            // Delete the user's avatar if it's not the default avatar
            if (!empty($avatar)) {
                $avatarPath = public_path('assets/images/' . $avatar);
                if (File::exists($avatarPath)) {
                    File::delete($avatarPath);
                }
            }

            // Delete the user from the database
            $user->delete();

            // Commit the transaction if everything is fine
            DB::commit();

            // Redirect back with success message
            return redirect()->back()->with('success', 'User deleted successfully 🙂');
        } catch (\Exception $e) {
            // Rollback the transaction if there is an error
            DB::rollBack();

            // Log the error for debugging purposes
            Log::error('Error deleting user: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'User deletion failed 😞');
        }
    }

}
