<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WizardFormController extends Controller
{
    public function index()
    {
        return view('wizardform.pagination');
    }

    public function getData(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page    = $request->input('page', 1);
        $search  = $request->input('search', '');
        $sortBy  = $request->input('sort_by', 'id');
        $sortDir = $request->input('sort_dir', 'asc');

        // Define database columns and their display labels
        $columns = ['id', 'user_id', 'name', 'email', 'position', 'department', 'status','created_at', 'updated_at'];
        $columnLabels = [
            'id'         => 'ID',
            'user_id'    => 'User ID',
            'name'       => 'Name',
            'email'      => 'Email',
            'position'   => 'Position',
            'department' => 'Department',
            'status'     => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];

        // Start the base query
        $query = DB::table('users')->select($columns);

        // Apply search filtering
        if ($search) {
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', "%{$search}%");
                }
            });
        }

        // Get total count **before pagination**
        $total = $query->count();

        // Apply sorting and pagination
        $users = $query->orderBy($sortBy, $sortDir)
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        return response()->json([
            'columns' => $columnLabels,
            'rows'    => $users,
            'total'   => $total,
        ]);
    }
}