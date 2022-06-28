<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all categories
        $categories = Category::all();

        //return collection of categories as a resource
        return new CategoryResource(true, 'List all categories', $categories);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'user_id'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create category
        $category = Category::create([
            'name'     => $request->name,
            'user_id'   => $request->user_id,
        ]);

        //return response
        return new CategoryResource(true, 'New has category been added!', $category);
    }

    public function show(Category $category)
    {
        //return single category as a resource
        return new CategoryResource(true, 'Category found!', $category);
    }

    public function update(Request $request, Category $category)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'user_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update category
        $category->update([
            'name'     => $request->name,
            'user_id'   => $request->user_id,
        ]);


        //return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    public function destroy(Category $category)
    {
        //delete cate$category
        $category->delete();

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }
}
