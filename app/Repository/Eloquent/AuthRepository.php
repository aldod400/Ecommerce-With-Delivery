<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByIdentifier(string $identifier)
    {
        return filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? User::where('email', $identifier)->first()
            : User::where('phone', $identifier)->first();
    }

    public function register(array $data)
    {
        return User::create($data);
    }

    public function getUser()
    {
        return auth('api')->user();
    }

    public function updateUser(array $data)
    {
        $user = auth('api')->user();
        $user->update($data);
        return $user;
    }
    public function updateFcmToken(string $fcmToken)
    {
        return auth('api')->user()->update(['fcm_token' => $fcmToken]);
    }
}
