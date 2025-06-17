<?php

namespace App\Services\Contracts;

interface OrderServiceInterface
{
    public function getOrders(int $userId, int $perPage, ?string $status, ?string $paymentStatus, ?string $paymentMethod, ?string $search);
    public function create(array $data);
    public function getOrderById(int $id);
}
