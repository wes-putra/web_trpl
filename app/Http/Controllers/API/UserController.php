<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        $url = '/admin/users';
        
        return response()->json([
            'status' => 'success',
            'message' => 'Get data user successful',
            'users' => $users,
            'url' => $url
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $url = '/admin/users';

        return response()->json([
            'status' => 'success',
            'message' => 'Add user successful',
            'user' => $user,
            'url' => $url
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // dd($request->all());

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

        $url = '/admin/users';

        return response()->json([
            'status' => 'success',
            'message' => 'Edit user successful',
            'user' => $user,
            'url' => $url
        ]);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User has been removed',
        ]);
    }
}
