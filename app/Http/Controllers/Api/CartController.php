<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\StoreCartRequest;
use App\Http\Requests\Api\Cart\updateCartRequest;
use App\Services\Contracts\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = $this->cartService->getCart();
        return Response::api(__('message.Success'), 200, true, null, $carts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $result = $this->cartService->create([
            'product_id'          => $request->product_id,
            'quantity'            => $request->quantity,
            'attribute_value_ids' => $request->attribute_value_ids,
        ]);

        if (!$result['success'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api(__('message.Success'), 200, true, null, $result['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCartRequest $request, string $id)
    {
        $result = $this->cartService->update($id, $request->quantity);
        if (!$result['success'])
            return Response::api($result['message'], 400, false, 400);
        return Response::api($result['message'], 200, true, null, $result['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->cartService->delete($id);
        if (!$result['success'])
            return Response::api($result['message'], 400, false, 400);
        return Response::api($result['message'], 200, true, null);
    }
}
