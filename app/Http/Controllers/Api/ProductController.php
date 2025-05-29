<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function getProductsFromCategoryAndChildren(Request $request, int $categoryId)
    {
        $perPage = (int) $request->input('per_page', 10);

        $products = $this->productService
            ->getProductsFromCategoryAndChildren($categoryId, $perPage);

        return Response::api(__('message.Success'), 200, true, null, $products);
    }
    public function getProduct(int $id)
    {
        $product = $this->productService->getProductById($id);
        return Response::api(__('message.Success'), 200, true, null, $product);
    }
}
