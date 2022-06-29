<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $categories = Category::all();

        //render view with categories
        return view('categories.index', compact('categories'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        //validate form
        $this->validate($request, [
            'name'     => 'required'
        ]);

        //create category
        Category::create([
            'name'     => $request->name,
            'user_id'   => $user_id
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $category
     * @return void
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        //validate form
        $this->validate($request, [
            'name'   => 'required'
        ]);

        //update category
        $category->update([
            'name'     => $request->name,
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();

        //redirect to categories.index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
