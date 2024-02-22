<?php

namespace App\Http\Controllers;


class CartController extends Controller
{
    public function insertItemIntoCart(Request $request)
    {
        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->photo = $request->input('photo');
        $item->fkIdCategory = $request->input('fkIdCategory');
        $item->save();

        return response()->json(['message' => 'Item inserted successfully', 'data' => $item], 201);
    }

    public function updateCartItemQuantity(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->photo = $request->input('photo');
        $item->fkIdCategory = $request->input('fkIdCategory');
        $item->save();

        return response()->json(['message' => 'Item updated successfully', 'data' => $item]);
    }

    public function deleteCartItem($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }

    public function getCart($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function createCart($idUser)
    {
        $items = Item::all();
        return response()->json(['data' => $items]);
    }
}
