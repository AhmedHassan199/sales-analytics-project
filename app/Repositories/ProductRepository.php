<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getProductsByCategory(int $categoryId)
    {
        return Product::where('category_id', $categoryId)->get();
    }

    public function updateProductPrice(Product $product, float $newPrice)
    {
        $product->price = $newPrice;
        $product->save();
    }

    public function getAll()
{
    return Product::with('category')->latest()->get();
}

}
