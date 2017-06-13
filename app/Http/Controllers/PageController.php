<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;

class PageController extends Controller
{

    // Home Page
    public function homePage(){

        // Query 6 latest aricles post
        $articles = Post::where('mediatype_id', '=', 1)
                        ->with('tagged', 'category')
                        ->take(6)->get();

        // Query 8 latest videos post
        $videos = Post::where('mediatype_id', '=', 3)
                        ->with('tagged', 'category', 'series')
                        ->take(8)->get();

        // Query 8 popular audios
        $audios = Post::where('mediatype_id', '=', 2)
                        ->with('tagged', 'category', 'series')
                        ->take(8)->get();

        return view('visitor.index')->with([
                'articles' => $articles,
                'videos' => $videos,
                'audios' => $audios
            ]);
    }

    // Video Page
    public function videoPage(){

    }

    // Video Category Page
    public function videoCategory(Request $request, $category_id){

    }

    // Video Detail Page
    public function videoDetail(Request $request, $video_id){

    }

    // Article Page
    public function articlePage(){

    }

    // Article Category Page
    public function articleCategory(Request $request, $category_id){

    }

    // Article Detail Page
    public function articleDetail(Request $request, $article_id){

    }

    // Audio Page
    public function audioPage(){

    }

    // Audio Category Page
    public function audioCategory(Request $request, $category_id){

    }

    // Audio Detail Page
    public function audioDetail(Request $request, $audio_id){

    }

    // Search page
    public function search(Request $request){

    }

}
