<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function insertItem(Request $request): JsonResponse
    {

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'isoffer' => 'required|boolean',
            'fkidcategory' => 'required|numeric',
        ]);

        // Store the image file
        $photo = $request->file('photo');
        $imageName = '';
        if($photo)
        {
            $imageName = time().'.'.$photo->extension();
            $photo->move(public_path('images'), $imageName);
        }

        $itemID = Item::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'photo' => $imageName,
            'quantity' => $request->input('quantity'),
            'isoffer' => $request->input('isoffer'),
            'fkidcategory' => $request->input('fkidcategory'),
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

        //update image
        $photo = $request->file('photo');
        $imageName = time().'.'.$photo->extension(); //create image name
        $photo->move(public_path('images'), $imageName); //copying the image into the images folder

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->quantity = $request->input('quantity');
        $item->isoffer = $request->input('isoffer');
        $item->photo = $imageName;
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
