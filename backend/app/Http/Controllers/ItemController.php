<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function insertItem(Request $request): JsonResponse
    {
        $itemID = Item::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
//            'photo' => $request->input('photo'),
            'quantity' => $request->input('quantity'),
            'fkidcategory' => $request->input('fkIdCategory'),
        ]);

        if($itemID > 0) {
//            $user = User::getById($userID);
            return response()->json(['item' => $itemID], 201);
        } else {
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }

    public function updateItem(Request $request, $id): JsonResponse
    {
        $item = Item::getById($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->quantity = $request->input('quantity');
//        $item->photo = $request->input('photo');
        $item->fkIdCategory = $request->input('fkIdCategory');

        $updatedItem = Item::updateById($id, $item);

        if($updatedItem > 0)
        {
            $item = Item::getById();
            return response()->json(['item' => $item]);
        }

        return response()->json(['message' => 'Internal server error'], 500);
    }

    public function deleteItem($id): JsonResponse
    {
        $idDeleted = Item::deleteById($id);

        if($idDeleted == 1)
        {
            return response()->json(['message' => 'Item deleted successfully']);
        }
        else
        {
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    public function getItem($id): JsonResponse
    {
        $item = Item::getById($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json(['item' => $item]);
    }

    public function getItems(): JsonResponse
    {
        $items = Item::getAllItems();
        return response()->json(['items' => $items]);
    }
}
