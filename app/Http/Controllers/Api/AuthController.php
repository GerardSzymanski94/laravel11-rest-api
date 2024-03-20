<?php

namespace App\Http\Controllers\Api;

use App\Enums\ApiStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => ApiStatusEnum::ERROR,
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => ApiStatusEnum::SUCCESS,
                'token' => $user->createToken("API TOKEN", ['*'], now()->addHours(2))->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => ApiStatusEnum::ERROR,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
