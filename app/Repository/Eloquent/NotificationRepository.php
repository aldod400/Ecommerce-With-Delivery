<?php

namespace App\Repository\Eloquent;

use App\Models\Notification;
use App\Repository\Contracts\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getNotificationsByUserId($userId)
    {
        return Notification::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
    public function create(array $data)
    {
        return Notification::create($data);
    }
}
