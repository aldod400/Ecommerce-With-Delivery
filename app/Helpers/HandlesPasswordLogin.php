<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

trait HandlesPasswordLogin
{
    protected function performPasswordCheck($user, string $password): array
    {
        if (!$user) {
            return ['success' => false, 'message' => __('message.Invalid Email or Phone')];
        }

        if (!Hash::check($password, $user->password)) {
            return ['success' => false, 'message' => __('message.Invalid Password')];
        }

        return ['success' => true, 'user' => $user];
    }
}
