<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function login(string $identifier, string $password, string $fcmToken);
    public function register(array $data);
    public function profile();
    public function updateProfile(array $data);
    public function updateFcmToken(string $fcmToken);
}
