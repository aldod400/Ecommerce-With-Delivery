<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    protected $bannerService;
    protected $categoryService;
    protected $productService;
    public function __construct(
        BannerServiceInterface $bannerService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
    ) {
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
        $this->productService = $productService;
    }
    public function getBanners()
    {
        $banners = $this->bannerService->getBanners();
        return Response::api(__('message.Success'), 200, true, null, $banners);
    }
    public function popularCategories()
    {
        $categories = $this->categoryService->getPopularCategory();
        return Response::api(__('message.Success'), 200, true, null, $categories);
    }
    public function getLatestProducts()
    {
        $products = $this->productService->getLatestProducts(50);

        return Response::api(__('message.Success'), 200, true, null, $products);
    }
}
