<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            $url = '/admin/user';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data user successful',
                'users' => $users,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8',
                'role' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $url = '/admin/user';

            return response()->json([
                'status' => 'success',
                'message' => 'Add user successful',
                'user' => $user,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(string $id){
        try {
            $user = User::findOrFail($id);

            $url = sprintf('/admin/user/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get user successful',
                'user' => $user,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'sometimes|required|confirmed|min:8',
            ]);

            $data = [
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            $url = '/admin/user';

            return response()->json([
                'status' => 'success',
                'message' => 'Edit user successful',
                'user' => $user,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $url = '/admin/user';

            return response()->json([
                'status' => 'success',
                'message' => 'User has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
