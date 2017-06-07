<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\PlaylistSerie;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Admin;
use App\Models\FileEntry;
use Auth;
use Session;

class PostController extends Controller
{

    // Query all type of posts
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(15);
        return view('admin.post.posts')->with(['posts' => $posts]);
    }

    // Query only posts type article
    public function articlePost(){
        $posts = Post::where('mediatype_id', '=', 1)->paginate(15);
        return view('admin.post.posts')->with(['posts' => $posts]);
    }

    // Query only posts type sound
    public function soundPost(){
        $posts = Post::where('mediatype_id', '=', 2)->paginate(15);
        return view('admin.post.posts')->with(['posts' => $posts]);
    }

    // Query only posts type video
    public function videoPost(){
        $posts = Post::where('mediatype_id', '=', 3)->paginate(15);
        return view('admin.post.posts')->with(['posts' => $posts]);
    }

    // Return post creation fom with default data for Article type
    public function create()
    {

        // Query all existing tags with any post
        $tags = Post::existingTags()->pluck('name');

        // Query all category which belong to articale type #1
        try{
            $articalType = CategoryType::findOrFail(1);
        }catch(ModelNotFoundException $e){
            Session::flash('error_message', 'Cannot find media type reading');
            return redirect()->back();
        }

        $categories = $articalType->categories;

        // Query all series related to articale type #1
        $series = PlaylistSerie::where('mediatype_id','=', 1)->get();
        return view('admin.post.create_post')->with([
                'tags' => $tags,
                'categories' => $categories,
                'series' => $series
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'mediatype_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' => 'required',
        ]);

        // Determine post type
        if($request->mediatype_id == '1'){ // Article type #1
            $this->validate($request, [
                'content' => 'required|min:10',
            ]);
        }else if($request->mediatype_id == '2'){ // Sound type #2
            $this->validate($request, [
                'sound_url' => 'required',
            ]);
        }else if($request->mediatype_id == '3'){ // Video type
            $this->validate($request, [
                'video_url' => 'required',
            ]);
        }else{
            Session::flash('error_message', 'Ops! invalid media type id : '.$request->mediatype_id);
            return redirect()->back();
        }

        // Start create post object & save
        try{

            // Instanciate post object
            $post = new Post($request->all());

            // Associate post with category
            $category = Category::where('id', '=', $request->category_id)->first();
            if(!$category->count() <= 0){
                $post->category()->associate($category);
            }

            // Associate post with admin
            $post->createdBy()->associate(Auth::user());

            if($request->has('featured_image')){
                $post->featured_image = $request->input('featured_image');
                $post->featured_image = str_replace('uploads','thumbs',$post->featured_image);
            }

            // Save post once before attach Series and Tags
            $post->save();

            if($request->has('series')){
                $post->attachSeries($request->input('series'));
            }

            if($request->has('tags')){
                $post->tag(explode(',', $request->tags));
            }

            // Save post again after attach Series and Tags
            $post->save();

            // Create session successful message and redirect back
            Session::flash('success_message', 'Post successfully added!');
            return redirect(route('admin.post.edit', $post->id));
        }catch(Exception $e){
            Session::flash('error_message', 'Ops! Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($content_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        try{
            $post = Post::findOrFail($post_id);
        }catch(ModelNotFoundException $e){
            Session::flash('error_message', 'Query result not found for post ID : '.$post_id);
            return redirect()->back();
        }

        try{

            // Query all existing tags with any post
            $tags = Post::existingTags()->pluck('name');

            // Query all category which belong to this post type
            try{
                $articalType = CategoryType::findOrFail($post->mediatype_id);
            }catch(ModelNotFoundException $e){
                Session::flash('error_message', 'Cannot find media type by id');
                return redirect()->back();
            }

            $categories = $articalType->categories;

            // Query all series related to articale type #1
            $series = PlaylistSerie::where('mediatype_id','=', $post->mediatype_id)->get();

        }catch(Exception $e){
            Session::flash('error_message', 'Error occured while trying to query related table');
            return redirect()->back();
        }

        return view('admin.post.update_post')
                ->with([
                    'post' => $post,
                    'tags' => $tags,
                    'series' => $series,
                    'categories' => $categories
                ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'mediatype_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' => 'required',
        ]);

        // Determine post type
        if($request->mediatype_id == '1'){ // Article type #1
            $this->validate($request, [
                'content' => 'required|min:10',
            ]);
        }else if($request->mediatype_id == '2'){ // Sound type #2
            $this->validate($request, [
                'sound_url' => 'required',
            ]);
        }else if($request->mediatype_id == '3'){ // Video type
            $this->validate($request, [
                'video_url' => 'required',
            ]);
        }else{
            Session::flash('error_message', 'Ops! invalid media type id : '.$request->mediatype_id);
            return redirect()->back();
        }

        // Determine if post exist
        try{
            $post = Post::findOrFail($post_id);
        }catch(ModelNotFoundException $e){
            Session::flash('error_message', 'Query not found by post id : '.$post_id);
            return redirect()->back();
        }

        // Trying to update post with new data
        try{

            $post->updatedBy()->associate(Auth::user());
            $category = Category::where('id', '=', $request->category_id)->first();

            if(!$category->count() <= 0){
                $post->category()->associate($category);

                // Check for thumbnail image
                if($request->has('featured_image')){
                    $post->featured_image = $request->input('featured_image');
                    $post->featured_image = str_replace('uploads','thumbs',$post->featured_image);
                }

                if($request->has('series')){
                    $post->attachSeries($request->input('series'));
                }

                if($request->has('tags')){
                    $post->retag(explode(',', $request->tags));
                }

                $post->update($request->all());
            }else{
                Session::flash('error_message', 'Query not found by category id');
                return redirect()->back();
            }

        }catch(Exception $e){
            Session::flash('error_message', 'error occured while trying to update post!');
            return redirect()->back();
        }

        Session::flash('success_message', 'Successfully updated post!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){

            // Determine if post exist
            if($request->has('id')){
                $postId = $request->input('id');
                try{
                    $post = Post::findOrFail($postId);
                }catch(ModelNotFoundException $e){
                    return response()->json([
                        "status" => 202,
                        "error" => [
                            "code" => 202,
                            "message" => "No Query result found for post ID : ".$postId
                        ]
                    ]);
                }

                // Try to delete post
                try{
                    $post->delete();
                }catch(Exception $e){
                    return response()->json([
                        "status" => 505,
                        "error" => [
                            "code" => 505,
                            "message" => "Error while trying to delete post"
                        ]
                    ]);
                }

                // Response with successful message
                return response()->json([
                    "status" => 200,
                    "success" => [
                        "code" => 200,
                        "message" => "Successfully deleted post with ID : ".$postId
                    ]
                ]);
            }

            // Request must specify post id
            return response()->json([
                "status" => 202,
                "error" => [
                    "code" => 202,
                    "message" => "Invalid request data"
                ]
            ]);
        }

        // Return if rquest not an AJAX
        return redirect()->back();
    }


}
