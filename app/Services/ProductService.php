<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

   
    public function updatePricesByCategory(int $categoryId, float $percent)
    {
        $products = $this->productRepo->getProductsByCategory($categoryId);

        foreach ($products as $product) {
            $newPrice = $product->price * (1 + $percent / 100);
            $this->productRepo->updateProductPrice($product, $newPrice);
        }
    }

    public function getAllProducts()
{
    return $this->productRepo->getAll();
}

}
