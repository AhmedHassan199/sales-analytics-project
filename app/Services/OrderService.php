<?php
namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService {
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data) {
        $data['total_price'] = $data['quantity'] * $data['total_price'];
        unset($data['price']);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->orderRepository->createOrder($data);
    }

    public function getOrders() {
        return $this->orderRepository->getAllOrders();
    }

    public function deleteOrder($id) {
        return $this->orderRepository->deleteOrder($id);
    }

}

