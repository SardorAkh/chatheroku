<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userOnline(Request $request): \Illuminate\Http\JsonResponse
    {
        $user_id = $request->query->get("user_id");
        $user = User::find($user_id);
        $user->is_active = true;
        $user->save();

        return response()->json("",204);
    }
    public function userOffline(Request $request): \Illuminate\Http\JsonResponse
    {
        $user_id = $request->query->get("user_id");
        $user = User::find($user_id);
        $user->is_active = false;
        $user->save();

        return response()->json("",204);
    }
    public function getActiveUsers() {
        return User::where("is_active", "=", true)->get();
    }
}
