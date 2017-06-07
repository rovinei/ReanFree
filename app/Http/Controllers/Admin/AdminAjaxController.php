<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\PlaylistSerie;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\FileEntry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Department;
use Auth;
use Session;

class AdminAjaxController extends Controller
{
    public function getTypeCategories(Request $request){
        if($request->ajax()){
            if($request->has('typeid')){
                $mediaid = $request->input('typeid');
                try {
                    $type = CategoryType::findOrFail($mediaid);
                } catch (ModelNotFoundException $e) {
                    return response()->json([
                        "status" => 404,
                        "error" => [
                            "code" => 202,
                            "message" => "No Query result for media"
                        ]
                    ]);
                }

                // Query categories by type
                $categories = $type->categories;

                // Query all series related to articale type #1
                $series = PlaylistSerie::where('mediatype_id','=', $mediaid)->get();

                return response()->json([
                        'categories' => $categories,
                        'series' => $series
                    ]);
            }
            return response()->json([
                "status" => 202,
                "error" => [
                    "code" => 202,
                    "message" => "Invalid request data"
                ]
            ]);
        }
        return redirect()->back();
    }

    public function addSerie(Request $request){
        if($request->ajax()){
            if($request->has('title') & $request->has('type')){
                $validType = array(1 ,2 ,3);
                $title = $request->input('title');
                $type = $request->input('type');
                if(!in_array($type, $validType)){
                    return response()->json([
                        "status" => 202,
                        "error" => [
                            "code" => 202,
                            "message" => "Invalid request data, media type must 1, 2 or 3"
                        ]
                    ]);
                }

                try {
                    $serie = new PlaylistSerie();
                    $serie->title = $title;
                    $serie->mediatype_id = $type;
                    $serie->createdBy()->associate(Auth::user());
                    $serie->save();
                    $data = $serie->toArray();
                } catch (Exception $e) {
                    return response()->json([
                        "status" => 500,
                        "error" => [
                            "code" => 500,
                            "message" => "Error while trying to insert into database"
                        ]
                    ]);
                }

                return response()->json([
                    "status" => 200,
                    "data" => $data,
                    "success" => [
                        "code" => 200,
                        "message" => "Successfully Created Serie with title : ".$title
                    ]
                ]);
            }

            return response()->json([
                "status" => 202,
                "error" => [
                    "code" => 202,
                    "message" => "Invalid request data"
                ]
            ]);
        }

        return redirect()->back();
    }

    public function removePost(Request $request){
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
