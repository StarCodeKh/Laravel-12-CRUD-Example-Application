<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // DataTables parameters
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowPerPage = $request->get("length");
        $order      = $request->get('order');
        $columns    = $request->get('columns');
        $search     = $request->get('search');

        // Column ordering
        $columnIndex     = $order[0]['column'];
        $columnName      = $columns[$columnIndex]['data'];
        $columnSortOrder = $order[0]['dir']; // asc or desc

        // Search term
        $searchValue = $search['value'];

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
            'Inactive'  => 'bg-danger-subtle text-danger',
            'Pending'   => 'bg-primary-subtle text-primary',
            'Suspended' => 'bg-warning-subtle text-warning',
            'Active'    => 'bg-success-subtle text-success',
        ];

        $data_arr = [];

        foreach ($records as $key => $record) {
            $last_login = Carbon::parse($record->last_login)->diffForHumans();

            $action = '
                <div class="d-flex gap-2">
                    <button class="btn btn-info btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewUser" aria-controls="viewUser">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>';

            $statusText = $record->status;
            $badgeClass = $badgeClasses[$statusText] ?? 'bg-secondary-subtle text-secondary';
            $status     = "<span class=\"badge {$badgeClass}\">{$statusText}</span>";

            $data_arr[] = [
                "action"       => $action,
                "no"           => '<span class="id" data-id="'.$record->id.'">'.($start + $key + 1).'</span>',
                "name"         => $record->name,
                "user_id"      => '<span class="user_id">'.$record->user_id.'</span>',
                "email"        => '<span class="email">'.$record->email.'</span>',
                "position"     => '<span class="position">'.$record->position.'</span>',
                "phone_number" => '<span class="phone_number">'.$record->phone_number.'</span>',
                "join_date"    => $record->join_date,
                "last_login"   => $last_login,
                "role_name"    => $record->role_name,
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
    
}
