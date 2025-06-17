<?php

namespace App\Repository\Contracts;

interface NotificationRepositoryInterface
{
    public function getNotificationsByUserId($userId);
    public function create(array $data);
}
