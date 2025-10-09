<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function categoryIndex()
    {
        $categories = Categories::where('status', 1)->get();
        return view('admin.category.all', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);

        $category = new Categories();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = Helpers::customUpload('category-image', $request->file('image'));
        $category->save();
        return redirect()->back()->with('modal-success', 'Category Stored Successfully');
    }

    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $category = Categories::findOrFail($request->id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $category->image = Helpers::customUpload('category-image', $request->file('image'));
        }

        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
        ]);
    }

    public function categoryDelete($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('modal-success','Category Deleted Successfully');
    }


}
