<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Category;
use Auth;
use Session;
class CategoryController extends Controller
{
    // Display list of categories
    public function index(Request $request){

        // Query all categories
        $categories = Category::whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.category.category')->with(['categories' => $categories]);
    }

    // Creation category form
    public function create(Request $request){

        return view('admin.category.create_category');
    }

    // Store new category
    public function store(Request $request){

        // Validate form data
        $this->validate($request,[
            'name' => 'required|min:5|unique:categories',
            'mediatype_id' => 'required|numeric|max:2'
        ]);

        // Create and Store new category
        try{
            $category = new Category($request->all());
            $category->createdBy()->associate(Auth::user());
            $category->save();
            $category->mediaTypes()->attach($request->mediatype_id);
            $category->save();
            Session::flash('success_message', 'Category '.$category->name.' successfully created.');
            return redirect()->back();

        }catch(Exception $e){
            Session::flash('error_message', 'Oop! Something went wrong, Please try again!');
            return redirect()->back();
        }
    }

    // Edit category
    public function edit(Request $request, $category_id){

        // Determine if category existed
        try{
            $category = Category::firstOrFail($category_id);
            return view('admin.category.update_category')->with(['category', $category]);
        }catch(ModelNotFoundException $e){
            Session::flash('error_message', 'Query return 0 result, Category cannot be found with this id : '.$category_id);
            return redirect()->back();
        }
    }

    // Update category
    public function update(Request $request, $category_id){

        // Validate form data
        $this->validate($request, [
            'name' => 'required|min:5|unique:categories',
            'mediatype_id' => 'required|numeric|max:2'
        ]);

        // Determine if category exists
        try{
            $category = Category::firstOrFail($category_id);
            $category->updatedBy()->associate(Auth::user());
            $category->update($request->all());
        }catch(Exception $e){

        }
    }
}
