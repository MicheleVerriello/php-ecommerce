<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function insertOrder(Request $request)
    {
        try {
            $this->validate($request, [
                'fkiduser' => 'required|integer',
                'totalPrice' => 'required|number'
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }


        $order = Order::createOrder($request->input('fkiduser'), $request->input('totalPrice'));

        if ($order) {
            return response()->json(['success' => $order], 200);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }

    public function getOrdersByUserId($userId)
    {

    }

    public function getOrderDetails($id)
    {

    }

    public function deleteOrder($id)
    {

    }

    public function getItems()
    {

    }
}
