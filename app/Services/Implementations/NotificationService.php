<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\NotificationRepositoryInterface;
use App\Services\Contracts\NotificationServiceInterface;

class NotificationService implements NotificationServiceInterface
{
    protected $notificationRepo;

    public function __construct(NotificationRepositoryInterface $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }

    public function getNotifications($userId)
    {
        return $this->notificationRepo->getNotificationsByUserId($userId);
    }
}
