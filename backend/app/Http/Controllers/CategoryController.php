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

        $categories = Category::searchCategories($name);
        if(count($categories) > 0) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        $category = Category::createCategory(['name' => $name]);

        if($category != null) {
            $response = Category::getById($category);
            return response()->json(['category' => $response], 201);
        } else {
            return response()->json(['error' => 'Bad request'], 400);
        }
    }

    public function getCategoryById($id): JsonResponse
    {
        $category = Category::getById($id);

        if($category != null) {
            return response()->json(['category' => $category], 200);
        } else {
            return response()->json(['error' => 'Internal Server Error'], 500);
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

    public function searchCategory(Request $request): JsonResponse
    {
        $searchValue = $request->query('searchValue');

        if($searchValue != null) {
            $categories = Category::searchCategories($searchValue);
        } else {
            $categories = Category::getAllCategories();
        }

        return response()->json(['categories' => $categories]);
    }
}
