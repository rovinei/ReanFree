<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use Carbon\Carbon;

class PageController extends Controller
{

    // Home Page
    public function homePage(){

        // Query 6 latest aricles post
        $articles = Post::where('mediatype_id', '=', 1)
                        ->with('tagged', 'category')
                        ->latest()
                        ->take(6)->get();

        // Query 8 latest videos post
        $videos = Post::where('mediatype_id', '=', 3)
                        ->with('tagged', 'category')
                        ->latest()
                        ->take(8)->get();

        // Query 8 popular audios
        $audios = Post::where('mediatype_id', '=', 2)
                        ->with('tagged', 'category')
                        ->latest()
                        ->take(8)->get();

        return view('visitor.index')->with([
                'articles' => $articles,
                'videos' => $videos,
                'audios' => $audios,
            ]);
    }

    // Article Page
    public function articlePage(){

        // Find categories of type reading
        $categories = CategoryType::find(1)->with(['categories'=>function($query){
            $query->has('latestArticle')->get();
        }])->first();
        $articles = Post::where('mediatype_id', '=', 1)->latest()->take(6)->get();
        $suggestArticles = Post::where('mediatype_id', '=', 1)
                                ->where('created_at', '<', Carbon::today())
                                ->take(4)->get();
        return view('visitor.article.index')->with([
                'categories' => $categories,
                'articles' => $articles,
                'suggestArticles' => $suggestArticles
            ]);

    }

    // Article Category Page
    public function articleCategory(Request $request, $category_id){

        // Find category by id
        try{
            $articles = Post::where('mediatype_id', '=', 1)
                            ->where('category_id', '=', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate(16);
            $suggestArticles = Post::where('mediatype_id', '=', 1)
                                ->where('created_at', '<=', Carbon::today())
                                ->take(4)->get();
            $category_name = $articles[0]->category->name;
        }catch(ModelNotFoundException $e){
            absort(404, 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.article.article_category')->with([
            'articles' => $articles,
            'category_name' => $category_name,
            'suggestArticles' => $suggestArticles
        ]);

    }

    // Article Detail Page
    public function articleDetail(Request $request, $article_id){

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
