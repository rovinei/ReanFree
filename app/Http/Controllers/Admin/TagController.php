<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Conner\Tagging\Model\Tag;
use Conner\Tagging\Model\Tagged;
use Session;
use Auth;
use Exception;

class TagController extends Controller
{

    // Display tags
    public function index(Request $request){

        // Find all existing tags
        $tags = Tag::orderBy('name','desc')->paginate(10);
        return view('admin.tag.index')->with(['tags' => $tags]);
    }

}
