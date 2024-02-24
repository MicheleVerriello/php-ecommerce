<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request): JsonResponse
    {

        $name = $request->input('name');

        $category = Category::createCategory(['name' => $name]);

        if($category != null) {
            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['error' => 'Bad request'], 400);
        }
    }

    public function deleteCategory($id): JsonResponse
    {
        $deleted = Category::deleteById($id);

        if($deleted != null) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'Bad request'], 400);
        }
    }
//
//    public function updateCategory(Request $request): JsonResponse
//    {
//
//    }
//
//    public function searchCategory(Request $request): JsonResponse
//    {
//
//    }
}
