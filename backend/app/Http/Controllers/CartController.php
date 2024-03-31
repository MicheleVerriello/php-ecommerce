<?php

namespace App\Http\Controllers;


use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function insertItemIntoCart(Request $request)
    {
        try {
            $this->validate($request, [
                'fkiduser' => 'required|integer',
                'fkiditem' => 'required|integer'
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }


        $cartItem = CartItem::addItemToCart($request->input('fkiduser'), $request->input('fkiditem'), 1);

        if ($cartItem) {
            return response()->json(['success' => $cartItem], 200);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }


    public function updateCartItemQuantity(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'quantity' => 'required|integer'
            ]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => 'The sent values are not valid. ' . $exception->getMessage()], 400);
        }


        $cartItem = CartItem::updateCartItemQuantity($id, $request->input('quantity'), 1);

        if ($cartItem > 0) {
            return response()->json(['success' => $cartItem], 200);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }

    public function deleteCartItem($id)
    {
        $deleted = CartItem::deleteCartItem($id);

        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }

    public function getCartByUserId($idUser)
    {
        $cartItems = CartItem::getCartByUserId($idUser);

        if($cartItems != null)
        {
            return response()->json(['cartItems' => $cartItems], 200);
        }
    }

    public function clearCart($idUser)
    {
        $deleted = CartItem::deleteCart($idUser);

        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }
}
