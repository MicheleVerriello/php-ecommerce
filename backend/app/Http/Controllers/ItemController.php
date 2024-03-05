<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            $item = Item::getById($itemID);
            return response()->json(['item' => $item]);
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
        $item->fkidcategory = $request->input('fkIdCategory');

        $updatedItem = Item::updateById($id, $item);

        if($updatedItem > 0)
        {
            $item = Item::getById($id);
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

    public function getItems(Request $request): JsonResponse
    {

        $searchValue = $request->query('searchValue');

        if($searchValue != null) {
            $items = Item::searchItems($searchValue);
        } else {
            $items = Item::getAllItems();
        }
        return response()->json(['items' => $items]);
    }
}
