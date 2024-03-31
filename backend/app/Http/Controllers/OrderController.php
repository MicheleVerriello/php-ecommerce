<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function insertOrder(Request $request)
    {
        try {
            $this->validate($request, [
                'fkiduser' => 'required|integer',
                'totalPrice' => 'required|numeric',
                'orderItems' => 'required|array', // Ensure it's an array
                'orderItems.*.fkiditem' => 'required|integer', // Validation for fkiditem in each object
                'orderItems.*.quantity' => 'required|integer|min:1', // Validation for quantity in each object
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }

        //decreasing quantity for ordered items
        foreach ($request->orderItems as $key => $orderItem) {
            Item::decreseQuantity($orderItem['fkiditem'], $orderItem['quantity']);
        }

        $orderInserted = Order::createOrder($request->input('fkiduser'), $request->input('totalPrice'));

        if ($orderInserted > 0) {
            //adding order items
            foreach ($request->orderItems as $key => $orderItem) {
                OrderItem::insertOrderItem($orderInserted, $orderItem['fkiditem'], $orderItem['quantity']);
            }

            return response()->json(['id' => $orderInserted]);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }

    public function getOrdersByUserId($userId)
    {
        $orders = Order::getOrdersByUserId($userId);

        if($orders != null) {
            return response()->json(['orders' => $orders]);
        } else {
            return response()->json(['error' => 'not found'], 404);
        }
    }

    public function getOrderDetails($id)
    {
        $orderDetails = Order::getOrderDetails($id);

        if($orderDetails != null) {
            return response()->json(['$orderDetails' => $orderDetails]);
        } else {
            return response()->json(['error' => 'not found'], 404);
        }
    }

    public function deleteOrder($id)
    {
        $deleted = Order::deleteOrder($id);

        if($deleted != null) {
            return response()->json(['deleted' => $deleted]);
        } else {
            return response()->json(['error' => 'not found'], 404);
        }
    }

    public function getOrderItemsByOrderId($id)
    {
        $orderItems = OrderItem::getOrderItemsByOrderId($id);

        if($orderItems != null) {
            return response()->json(['orderItems' => $orderItems]);
        } else {
            return response()->json(['error' => 'not found'], 404);
        }
    }
}
