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
        return response()->json(['user' => $user], 200);
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
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout succeeded!',
            'success' => true,
        ], 200);
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
            'role' => false,
        ]);

        $token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 200);
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
            'message' => $success ? 'Password changed' : 'Error changing password',
        ]);
    }

    public function changeFirstName(Request $request)
    {
        $changeFirstName = $request->validate([
            'first_name' => 'string|min:1|max:25',
        ]);

        $user = $request->user();

        $success = DB::table('users')
            ->where('email', $user->email)
            ->update([
                'first_name' => $changeFirstName['first_name'],
            ]);

        return response()->json([
            'success' => $success,
            'message' => $success ? 'First name changed' : 'Error changing first name',
        ]);
    }

    public function changeLastName(Request $request)
    {
        $changeLastName = $request->validate([
            'last_name' => 'string|min:1|max:25',
        ]);

        $user = $request->user();

        $success = DB::table('users')
            ->where('email', $user->email)
            ->update([
                'last_name' => $changeLastName['last_name'],
            ]);

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Last name changed' : 'Error changing last name',
        ]);
    }

    public function projects(User $user)
    {
        $success = DB::table('projects')
            ->leftJoin('project_members', 'projects.owner_email', '=', 'project_members.member_email')
            ->where('project_members.member_email', $user->email)
            ->orWhere('projects.owner_email', $user->email)
            ->select('projects.*')
            ->get();

        return response()->json(['projects' => $success]);
    }

    public function projectMembers(User $user)
    {
        return response()->json($user->projectMembers()->orderBy('project_name'));
    }
}
