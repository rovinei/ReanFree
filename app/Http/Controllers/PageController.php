<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\PlaylistSerie;
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
        $categories = CategoryType::where('mediatype_id', 3)->with(['categories'=>function($query){
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
                            ->where('category_id', '=', $category_id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(16);
            $suggestArticles = Post::where('mediatype_id', '=', 1)
                                ->where('created_at', '<=', Carbon::today())
                                ->take(4)->get();
            $category_name = $articles[0]->category->name;
        }catch(ModelNotFoundException $e){
            absort(404, 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.article.category')->with([
            'articles' => $articles,
            'category_name' => $category_name,
            'suggestArticles' => $suggestArticles
        ]);

    }

    // Article Detail Page
    public function articleDetail(Request $request, $article_id){

        // Find article by id
        try {
            $article = Post::where('id', $article_id)
                            ->with('tagged','category')
                            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view('errors.404')->with('exception', 'Oop! article you requested does not exist!');
        }

        // Query related article base on tag
        $relatedArticles = Post::where('id', '!=', $article_id)
                            ->where('mediatype_id', 1)
                            ->withAnytag($article->tagNames())
                            ->latest()
                            ->take(6)->get();

        // Query the most latest article cross category
        $recentArticles = Post::where('id', '!=', $article_id)
                            ->where('mediatype_id', '=', 1)
                            ->latest()
                            ->take(6)->get();

        // if related article is empty,
        // Query article base on category instead
        if(count($relatedArticles) <= 0){
            $relatedArticles = Post::where('id', '!=', $article_id)
                            ->where('mediatype_id', '=', 1)
                            ->where('category_id', '=', $article->category->id)
                            ->latest()
                            ->take(6)->get();
        }

        return view('visitor.article.detail')->with([
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'recentArticles' => $recentArticles
        ]);

    }

    // Video Page
    public function videoPage(){
        // Find categories of type video
        $categories = CategoryType::where('mediatype_id', 3)->with(['categories'=>function($query){
            $query->has('latestVideo')->get();
        }])->first();
        $videos = Post::where('mediatype_id', 3)->latest()->take(12)->get();
        $suggestVideos = Post::where('mediatype_id', 3)
                            ->whereNotIn('id', $videos->pluck('id')->toArray())
                            ->take(8)->get();
        return view('visitor.video.index')->with([
            'categories' => $categories,
            'videos' => $videos,
            'suggestVideos' => $suggestVideos
        ]);
    }

    // Video Category Page
    public function videoCategory(Request $request, $category_id){

        // Find category by id
        try{
            $videos = Post::where('mediatype_id', 3)
                            ->where('category_id', $category_id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(16);
            $suggestVideos = Post::where('mediatype_id', 3)
                                ->where('created_at', '<', Carbon::today())
                                ->take(8)->get();
            $category_name = $videos[0]->category->name;
        }catch(ModelNotFoundException $e){
            absort(404, 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.video.category')->with([
            'videos' => $videos,
            'category_name' => $category_name,
            'suggestVideos' => $suggestVideos
        ]);

    }

    // Video Detail Page
    public function videoDetail(Request $request, $video_id){

        // Find video by id
        try {
            $video = Post::where('id', $video_id)
                            ->with('tagged','category','series')
                            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view('errors.404')->with('exception', 'Oop! article you requested does not exist!');
        }

        // Query related videos base on serie playlist
        $serieid = $video->series->pluck('id')->first();
        if($serieid !== null){
            $serie = PlaylistSerie::where('id', $serieid)
                                ->with(['posts' => function($query){
                                        $query->where('id', '!=', 11)->take(12);
                                    }
                                ])->first();
        }else{
            $serie = PlaylistSerie::where('mediatype_id', 3)
                                ->with(['posts' => function($query){
                                        $query->where('id', '!=', 11)->take(12);
                                    }
                                ])->latest()->first();
        }

        // Find suggested next video
        $nextVideo = Post::where('id', '!=', $video_id)
                            ->where([
                                ['mediatype_id', 3],
                                ['title', 'like', $video->title.'%']
                            ])->first();

        // Find suggest next video by other way
        if(count($nextVideo) <= 0){
            $nextVideo = Post::where('id', '!=', $video_id)
                            ->where([
                                ['mediatype_id', 3],
                                ['title', 'like', '%'.$video->title.'%']
                            ])->first();
        }


        // Query videos base on category
        $relatedVideos = Post::where('id', '!=', $video_id)
                        ->where('mediatype_id', 3)
                        ->where('category_id', $video->category->id)
                        ->latest()
                        ->take(6)->get();

        // Query videos base on tag instead
        if(count($relatedVideos) <= 0){
            $relatedVideos = Post::where('id', '!=', $video_id)
                        ->where('mediatype_id', 3)
                        ->withAnytag($video->tagNames())
                        ->latest()
                        ->take(6)->get();
        }

        return view('visitor.video.detail')->with([
            'video' => $video,
            'serie' => $serie,
            'relatedVideos' => $relatedVideos,
            'nextVideo' => $nextVideo
        ]);

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

    // Find posts by tag
    public function findPostsByTag(Request $request, $tag_id){

    }

}
