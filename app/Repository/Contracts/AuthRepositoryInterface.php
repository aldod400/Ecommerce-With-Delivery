<?php

namespace App\Repository\Contracts;

interface AuthRepositoryInterface
{
    public function findByIdentifier(string $identifier);
    public function register(array $data);
    public function getUser();
    public function updateUser(array $data);
    public function updateFcmToken(string $fcmToken);
}
