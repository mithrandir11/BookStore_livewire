<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IOrderItemRepository;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    protected $orderItemRepository;
    public function __construct(IOrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function createOrderItem(Request $request){
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required',
        ]);
        $order_item = $this->orderItemRepository->createOrderItem($validated);
        return response()->json($order_item);
    }
}
