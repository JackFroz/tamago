<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
            return response(['success' => false], 403);

        $token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function register(Request $request)
    {
        $registerInfo = $request->validate([
            'email' => 'required|email|unique:users|max:320',
            'username' => 'required|unique:users',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'email' => $registerInfo['email'],
            'username' => $registerInfo['username'],
            'first_name' => $registerInfo['first_name'],
            'last_name' => $registerInfo['last_name'],
            'password' => Hash::make($registerInfo['password']),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function changePassword(Request $request)
    {
        $changePasswordInfo = $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'repeat_new_password' => 'required|same:new_password',
        ]);

        $user = $request->user();

        if (!Hash::check($changePasswordInfo['old_password'], $user->password))
            return response(['success' => false], 403);

        $success = DB::table('users')
            ->where('email', $user->email)
            ->update(['password' => Hash::make($changePasswordInfo['new_password'])]);

        return response()->json([
            'success' => $success,
        ]);
    }

    public function changeName(Request $request)
    {
        $changeName = $request->validate([
            'first_name' => 'string|min:1|max:25',
            'last_name' => 'string|min:1|max:25',
        ]);

        $user = $request->user();

        $success = DB::table('users')
            ->where('email', $user->email)
            ->update([
                'first_name' => $changeName['first_name'],
                'last_name' => $changeName['last_name'],
            ]);

        return response()->json([
            'success' => $success,
        ]);
    }

    public function projects(User $user)
    {
        $projects = DB::table('projects')
            ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.project_id')
            ->where('project_members.username', $user->username)
            ->orWhere('projects.username', $user->username)
            ->select('projects.*')
            ->get();

        return response()->json([
            'projects' => $projects,
        ]);
    }

    public function projectMembers(User $user)
    {
        return response()->json($user->projectMembers()->get());
    }
}
