<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        $url = '/admin/roles';
        
        return response()->json([
            'status' => 'success',
            'message' => 'Get data successful',
            'users' => $roles,
            'url' => $url
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
        ]);

        $role = Role::create([
            'role_name' => $request->role_name,
        ]);

        $url = '/admin/roles';

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'user' => $role,
            'url' => $url
        ]);
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role has been removed',
        ]);
    }
}
