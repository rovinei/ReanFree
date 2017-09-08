<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\PlaylistSerie;
use App\Models\Partner;
use Carbon\Carbon;
use Exception;

class PageController extends Controller
{

    // Home Page
    public function homePage(){

        // Query 6 latest aricles post
        $articles = Post::where([
                            ['mediatype_id', 1],
                            ['status', 1]
                        ])
                        ->with('tagged', 'category')
                        ->latest()
                        ->take(6)->get();

        // Query 8 latest videos post
        $videos = Post::where([
                            ['mediatype_id', 3],
                            ['status', 1]
                        ])
                        ->with('tagged', 'category')
                        ->latest()
                        ->take(8)->get();

        // Featured Slider Post
        $sliders = Post::whereNull('deleted_at')
                        ->where([
                            ['is_featured', 1],
                            ['status', 1]
                        ])
                        ->orderBy('mediatype_id', 'asce')
                        ->latest()
                        ->take(4)
                        ->get();

        // Partners
        $partners = Partner::where([
            'status' => 1,
            'is_featured' => 1,
        ])->get();


        return view('visitor.index')->with([
                'articles' => $articles,
                'videos' => $videos,
                'sliders' => $sliders,
                'partners' => $partners
            ]);
    }

    // Article Page
    public function articlePage(){

        // Find categories of type reading
        $categories = Category::where('mediatype_id', 1)
                            ->whereHas('latestArticle')
                            ->with('latestArticle')
                            ->get();

        $articles = Post::where([
                            ['mediatype_id', 1],
                            ['status', 1]
                        ])
                        ->latest()
                        ->take(6)
                        ->get();
        $suggestArticles = Post::where([
                                    ['mediatype_id', 1],
                                    ['status', 1],
                                    ['created_at', '<', Carbon::today()]
                                ])
                                ->take(4)
                                ->get();
        $latestSerie = PlaylistSerie::where([
                                        ['mediatype_id', 1],
                                        ['is_featured', 1]
                                    ])
                                    ->whereHas('posts')
                                    ->latest()
                                    ->first();
        return view('visitor.article.index')->with([
            'categories' => $categories,
            'articles' => $articles,
            'suggestArticles' => $suggestArticles,
            'latestSerie' => $latestSerie
        ]);

    }

    // Article Category Page
    public function articleCategory(Request $request, $slug){

        // Find category by id
        try{
            $category = Category::where('slug', $slug)->firstOrFail();

            $articles = Post::where([
                                ['mediatype_id', 1],
                                ['status', 1],
                                ['category_id', $category->id]
                            ])
                            ->orderBy('created_at', 'desc')
                            ->paginate(16);
            $suggestArticles = Post::where([
                                    ['mediatype_id', 1],
                                    ['status', 1],
                                    ['created_at', '<=', Carbon::today()]
                                ])
                                ->take(4)
                                ->get();
            $category_name = $category->name;
        }catch(ModelNotFoundException $e){
            return view('errors.404')->with('exception', 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.article.category')->with([
            'articles' => $articles,
            'category_name' => $category_name,
            'suggestArticles' => $suggestArticles
        ]);

    }

    // Article Serie
    public function articleSerie(Request $request, $serie_id){

        // Find playlist serie by id
        try {
            $serie = PlaylistSerie::where([
                                        ['mediatype_id', 1],
                                        ['id', $serie_id]
                                    ])
                                    ->whereHas('posts')
                                    ->with(['posts' => function($query){
                                        $query->whereNull('deleted_at')
                                            ->where('status', 1)
                                            ->orderBy('created_at', 'desc')
                                            ->get();
                                    }])
                                    ->firstOrFail();
            $suggestSeries = PlaylistSerie::where([
                                            ['mediatype_id', 1],
                                            ['id', '!=', $serie_id],
                                        ])
                                        ->whereHas('posts')
                                        ->latest()
                                        ->take(4)
                                        ->get();
        } catch (ModelNotFoundException $e) {
            return view('errors.404')->with('exception', 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.article.serie')->with([
            'serie' => $serie,
            'suggestSeries' => $suggestSeries
        ]);
    }

    // Article Detail Page
    public function articleDetail(Request $request, $slug){

        // Find article by id
        try {
            $article = Post::where([
                                ['slug', $slug],
                                ['status', 1]
                            ])
                            ->with('tagged','category')
                            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view('errors.404')->with('exception', 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        // Query related article base on tag
        $relatedArticles = Post::where([
                                ['id', '!=', $article->id],
                                ['mediatype_id', 1],
                                ['status', 1]

                            ])
                            ->withAnytag($article->tagNames())
                            ->latest()
                            ->take(6)->get();

        // Query the most latest article cross category
        $recentArticles = Post::where([
                                ['id', '!=', $article->id],
                                ['mediatype_id', 1],
                                ['status', 1]

                            ])
                            ->whereNotIn('id', $relatedArticles->pluck('id')->toArray())
                            ->latest()
                            ->take(6)->get();

        // if related article is empty,
        // Query article base on category instead
        if(count($relatedArticles) <= 0){
            $relatedArticles = Post::where([
                                ['id', '!=', $article->id],
                                ['mediatype_id', 1],
                                ['category_id', $article->category->id],
                                ['status', 1]

                            ])
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
        $categories = Category::where('mediatype_id', 3)
                            ->whereHas('latestVideo')
                            ->with('latestVideo')
                            ->get();
        $videos = Post::where([
                            ['mediatype_id', 3],
                            ['status', 1]
                        ])
                        ->latest()
                        ->take(12)
                        ->get();
        $suggestVideos = Post::where([
                                ['mediatype_id', 3],
                                ['status', 1]
                            ])
                            ->whereNotIn('id', $videos->pluck('id')->toArray())
                            ->take(8)
                            ->get();
        return view('visitor.video.index')->with([
            'categories' => $categories,
            'videos' => $videos,
            'suggestVideos' => $suggestVideos
        ]);
    }

    // Video Category Page
    public function videoCategory(Request $request, $slug){

        // Find category by id
        try{
            $category = Category::where('slug', $slug)->firstOrFail();
            $videos = Post::where([
                                ['mediatype_id', 3],
                                ['status', 1],
                                ['category_id', $category->id]
                            ])
                            ->orderBy('created_at', 'desc')
                            ->paginate(16);
            $suggestVideos = Post::where([
                                    ['mediatype_id', 3],
                                    ['status', 1],
                                    ['created_at', '<', Carbon::today()]
                                ])
                                ->take(8)
                                ->get();
            $category_name = $category->name;
        }catch(ModelNotFoundException $e){
            return view('errors.404')->with('exception', 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        return view('visitor.video.category')->with([
            'videos' => $videos,
            'category_name' => $category_name,
            'suggestVideos' => $suggestVideos
        ]);

    }

    // Video Detail Page
    public function videoDetail(Request $request, $slug){

        // Find video by id
        try {
            $video = Post::where([
                            ['slug', $slug],
                            ['status', 1]
                        ])
                        ->with('tagged','category','series')
                        ->firstOrFail();
            $vid = $video->id;
        } catch (ModelNotFoundException $e) {
            return view('errors.404')->with('exception', 'Oop! you have requested the resource that does not exists.\n We may considered create something new for you :D');
        }

        // Query related videos base on serie playlist
        $serieid = $video->series->pluck('id')->first();
        if($serieid !== null){
            $serie = PlaylistSerie::where('id', $serieid)
                                ->with(['posts' => function($query) use($vid) {
                                        $query->where([
                                                ['id', '!=', $vid],
                                                ['status', 1]
                                            ])->take(12);
                                    }
                                ])->first();
        }else{
            $serie = PlaylistSerie::where('mediatype_id', 3)
                                ->with(['posts' => function($query){
                                        $query->where([
                                            ['mediatype_id', 3],
                                            ['status', 1]
                                        ])->take(12);
                                    }
                                ])->latest()->first();
        }

        // Find suggested next video
        $nextVideo = Post::where([
                            ['id', '!=', $vid],
                            ['mediatype_id', 3],
                            ['title', 'like', $video->title.'%'],
                            ['status', 1]
                        ])
                        ->first();

        // Find suggest next video by other way
        if(count($nextVideo) <= 0){
            $nextVideo = Post::where([
                                ['id', '!=', $vid],
                                ['mediatype_id', 3],
                                ['title', 'like', '%'.$video->title.'%'],
                                ['status', 1]
                            ])->first();
        }


        // Query videos base on category
        $relatedVideos = Post::whereNotIn('id', [$vid,$nextVideo])
                            ->where([
                                    ['mediatype_id', 3],
                                    ['category_id', $video->category->id],
                                    ['status', 1]
                                ])
                            ->latest()
                            ->take(6)
                            ->get();

        // Query videos base on tag instead
        if(count($relatedVideos) <= 0){
            $relatedVideos = Post::whereNotIn('id', [$vid])
                                    ->where([
                                        ['mediatype_id', 3],
                                        ['status', 1]
                                    ])
                                    ->withAnytag($video->tagNames())
                                    ->latest()
                                    ->take(6)
                                    ->get();
        }

        return view('visitor.video.detail')->with([
            'video' => $video,
            'serie' => $serie,
            'relatedVideos' => $relatedVideos,
            'nextVideo' => $nextVideo
        ]);

    }

    // Search page
    public function search(Request $request){

        $query = $request->input('q') ? : '';
        if($query !== ""){
            try {
                $searchResults = Post::whereNull('deleted_at')
                                    ->where('title', 'like', '%'.$query.'%')
                                    ->orderBy('created_at', 'desc')
                                    ->with('category')
                                    ->paginate(20);
            } catch (Exception $e) {
                return view('errors.404')->with('exception', 'Oop! there is something went wrong while searching, please try again!');
            }

        }else{
            $searchResults = null;
        }

        return view('visitor.search')->with([
            'searchResults' => $searchResults,
            'query' => $query
        ]);
    }

    // Find posts by tag
    public function findPostsByTag(Request $request){

        $tag_slug = $request->input('name') ? : '';
        if($tag_slug !== ''){
            try {
                $searchResults = Post::withAnytag([$tag_slug])
                            ->with('category')
                            ->paginate(20);
            } catch (Exception $e) {
                return view('errors.404')->with('exception', 'Oop! there is something went wrong while searching by tag, please try again!');
            }

            return view('visitor.tag_search')->with([
                'searchResults' => $searchResults,
                'tag_slug' => $tag_slug
            ]);
        }else{
            return view('errors.404')->with('exception', 'Cannot search tag name empty, please try again!');
        }
    }

}
