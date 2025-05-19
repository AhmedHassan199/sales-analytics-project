<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function updatePrices(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|exists:categories,id',
            'percent' => 'required|numeric|min:0|max:100',
        ]);

        $categoryId = $request->input('category');
        $percent = $request->input('percent');

        $this->productService->updatePricesByCategory($categoryId, $percent);

        return redirect()->back()->with('success', 'Prices updated successfully.');
    }

        public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.index', compact('products'));
    }

}
