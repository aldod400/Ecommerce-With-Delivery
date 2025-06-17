<?php

namespace App\Repository\Contracts;

interface OrderRepositoryInterface
{
    public function getOrders(int $userId, int $perPage, ?string $status, ?string $paymentStatus, ?string $paymentMethod, ?string $search);
    public function create(array $data);
    public function update(int $id, array $data);
    public function getOrderById(int $id);
}
