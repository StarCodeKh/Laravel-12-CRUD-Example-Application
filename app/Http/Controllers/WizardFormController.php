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

        $columns = ['id', 'user_id', 'name', 'role_name', 'email', 'position', 'department', 'status', 'created_at', 'updated_at'];

        $columnLabels = [
            'id'         => 'No',
            'user_id'    => 'User ID',
            'name'       => 'Name',
            'role_name'  => 'Role Name',
            'email'      => 'Email',
            'position'   => 'Position',
            'department' => 'Department',
            'status'     => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'action'     => 'Action',
        ];

        $badgeClasses = [
            'Active'    => '<span class="badge bg-success-subtle text-success">Active</span>',
            'Inactive'  => '<span class="badge bg-danger-subtle text-danger">Inactive</span>',
            'Pending'   => '<span class="badge bg-primary-subtle text-primary">Pending</span>',
            'Suspended' => '<span class="badge bg-warning-subtle text-warning">Suspended</span>',
        ];

        $query = DB::table('users')->select($columns);

        if ($search) {
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', "%{$search}%");
                }
            });
        }

        $total = $query->count();

        $users = $query->orderBy($sortBy, $sortDir)
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        // Add status badge and action buttons
        $users->transform(function ($user) use ($badgeClasses) {
            $status = $user->status;
            $user->status = $badgeClasses[$status] ?? '<span class="badge bg-secondary-subtle text-secondary">'.e($status).'</span>';
            $user->action = '
                        <button class="btn btn-info btn-sm userView" data-bs-toggle="offcanvas" data-bs-target="#viewUser" aria-controls="viewUser">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm userUpdate" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm userDelete" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">
                            <i class="bi bi-trash"></i>
                        </button>';
            return $user;
        });

        return response()->json([
            'columns' => $columnLabels,
            'rows'    => $users,
            'total'   => $total,
        ]);
    }

    public function stepFormPage()
    {
        return view('wizardform.multi-step-form');
    }

}