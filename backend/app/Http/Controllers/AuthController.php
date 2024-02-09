<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::getByAttributes([
            'email' => $credentials[0],
            'password' => Hash::make($credentials[1])
        ]);

        if($user)

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function signup(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'address' => 'required|string',
                'phone' => 'required|string',
                'isAdmin' => 'required|boolean',
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }

        $userID = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'isAdmin' => $request->input('isAdmin'),
        ]);

        if($userID > 0) {
            $user = User::getByAttributes(['id' => $userID]);
            return response()->json(['user' => $user], 201);
        } else {
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }
}
