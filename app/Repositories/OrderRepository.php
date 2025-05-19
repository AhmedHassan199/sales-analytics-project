<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $data)
    {
        return DB::table('orders')->insert($data);
    }

        public function getAllOrders()
        {
            return DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->select([
                    'orders.*',
                    'products.name as product_name',
                    'products.description',
                ])
                ->paginate(10); 
        }


    public function deleteOrder($id)
    {
        return DB::table('orders')->where('id', $id)->delete();
    }


    public function getSalesData()
    {
        return DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.product_id', 'products.name', DB::raw('SUM(orders.total_price) as total_sales'))
            ->groupBy('orders.product_id', 'products.name')
            ->orderByDesc('total_sales')
            ->get();
    }
}
