<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::getUserByEmail($email);

        // checking if user exists
        if($user != null) {
            if (Hash::check($password, $user->password)) {
                unset($user->password);
                return response()->json(['user' => $user], 200);
            } else {
                return response()->json(['error' => 'Invalid credentials.'], 401);
            }
        } else {
            return response()->json(['error' => 'User Not Found'], 404);
        }
    }

    public function signup(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'address' => 'string',
                'phone' => 'string',
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
            $user = User::getById($userID);
            return response()->json(['user' => $user], 201);
        } else {
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }

    public function updateUser($id, Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email',
                'address' => 'string',
                'phone' => 'string',
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }

        $user = User::getById($id);

        if($user != null) {
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');

            $updated = User::updateUser($user);
            if ($updated > 0) {
                $user = User::getById($id);
                return response()->json(['user' => $user], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error.'], 500);
            }
        } else {
            return response()->json(['error' => 'User Not Found'], 404);
        }
    }

    public function updateUserPassword($id, Request $request)
    {
        try {
            $this->validate($request, [
                'newPassword' => 'required|string',
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }

        $user = User::getById($id);

        if($user != null) {

            $hashedNewPassword = Hash::make($request->input('newPassword'));
            $updated = User::updateUserPassword($id, $hashedNewPassword);

            if ($updated > 0) {
                $user = User::getById($id);
                return response()->json(['user' => $user], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error.'], 500);
            }
        } else {
            return response()->json(['error' => 'User Not Found'], 404);
        }
    }

    public function getUser($id): JsonResponse
    {
        $user = User::getById($id);
        if($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
}
