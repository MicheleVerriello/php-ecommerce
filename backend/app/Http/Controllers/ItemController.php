<?php

namespace App\Http\Controllers;


class ItemController extends Controller
{
    public function insertItem(Request $request)
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

    public function updateItem(Request $request, $id)
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

    public function deleteItem($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }

    public function getItem($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json(['data' => $item]);
    }

    public function getItems()
    {
        $items = Item::all();
        return response()->json(['data' => $items]);
    }

}
