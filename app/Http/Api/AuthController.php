<?php

namespace App\Http\Api;

use App\Enums\ApiStatusEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
