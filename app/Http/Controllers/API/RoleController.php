<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            $url = '/admin/roles';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data successful',
                'users' => $roles,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'role_name' => 'required',
            ]);

            $role = Role::create([
                'role_name' => $request->role_name,
            ]);

            $url = '/admin/roles';

            return response()->json([
                'status' => 'success',
                'message' => 'Role created successfully',
                'user' => $role,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create role',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove role',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
