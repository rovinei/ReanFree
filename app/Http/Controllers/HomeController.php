<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Post::existingTags()->pluck('name');
        return view('admin.dashboard', compact('tags'));
    }

    public function create()
    {
        $tags = Post::existingTags()->pluck('name');
        $medias = MediaType::all();
        return view('admin.post.create_post')->with(['tags' => $tags, 'medias' => $medias]);
    }

    public function getTypeCategories(Request $request){
        if($request->ajax()){
            if($request->has('typeid')){
                $mediaid = $request->input('typeid');
                $mediaObj = MediaType::findOrFail($mediaid);
                $categories = [];
                foreach($mediaObj->categories as $category){
                    array_push($categories, $category);
                }
            }
            return response()->json($categories);
        }
        return redirect()->back();
    }

}
