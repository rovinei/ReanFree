<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\PlaylistSerie;
use App\Models\CategoryType;
use App\Models\Category;
use Auth;
use Session;
use Exception;

class SerieController extends Controller
{


    // List all series
    public function index(Request $request){

        // Query series of article type #1
        $playlists = PlaylistSerie::orderBy('created_at', 'desc')
                                    ->with('category')
                                    ->paginate(15);

        return view('admin.serie.index')->with([
            'playlists' => $playlists
        ]);

    }

    public function create(Request $request){

        // Query all category of type article
        $categories = CategoryType::where('mediatype_id', 1)->with('categories')->first();
        return view('admin.serie.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request){

        // Validate Form Data
        $this->validate($request, [
            'title' => 'required|min:5',
            'category_id' => 'required|numeric|min:1',
            'mediatype_id' => 'required|numeric|min:1'
        ]);

        // Start create serie & save
        try{

            // Instanciate serie object
            $serie = new PlaylistSerie($request->all());

            // Associate serie with category
            $category = Category::where('id', $request->category_id)->first();
            if(!$category->count() <= 0){
                $serie->category()->associate($category);
            }

            // Associate serie with admin
            $serie->createdBy()->associate(Auth::user());

            // Save serie once before
            $serie->save();

            // Create session successful message and redirect back
            Session::flash('success_message', 'Serie successfully added!');
            return redirect()->back();

        }catch(Exception $e){
            Session::flash('error_message', 'Ops! Something went wrong');
            return redirect()->back();
        }

    }

    public function edit(Request $request, $serie_id){

        // Determine if serie existed
        try {
            $serie = PlaylistSerie::findOrFail($serie_id);
            $categories = CategoryType::where('mediatype_id', $serie->mediatype_id)->with('categories')->first();
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find serie with id : '.$serie_id);
            return redirect(route('admin.series'));
        }

        return view('admin.serie.update')->with([
            'serie' => $serie,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $serie_id){

        // Determine if serie existed
        try {
            $serie = PlaylistSerie::findOrFail($serie_id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find serie with id : '.$serie_id);
        }

        // Validate Form data
        $this->validate($request, [
            'title' => 'required|min:5',
            'category_id' => 'required|numeric|min:1',
            'mediatype_id' => 'required|numeric|min:1',
        ]);

        try {
            if(!$request->has('is_featured')){
                $serie->is_featured = 0;
            }
            $serie->updatedBy()->associate(Auth::user());
            $serie->update($request->all());

        } catch (Exception $e) {
            Session::flash('error_message', 'Oop! Something went wrong, Please try again.');
            return redirect(route('admin.series'));
        }

        Session::flash('success_message', 'Successfully updated serie');
        return redirect()->back();
    }

    // List all serie of article
    public function articleSerie(Request $request){

        // Query series of article type #1
        $playlists = PlaylistSerie::where('mediatype_id', '1')
                                    ->orderBy('created_at', 'desc')
                                    ->with('category')
                                    ->paginate(15);

        return view('admin.serie.index')->with([
            'playlists' => $playlists
        ]);

    }

    public function videoPlaylist(Request $request){

        // Query series of video type #3
        $playlists = PlaylistSerie::where('mediatype_id', '3')
                                    ->orderBy('created_at', 'desc')
                                    ->with('category')
                                    ->paginate(15);

        return view('admin.serie.index')->with([
            'playlists' => $playlists
        ]);
    }

    public function audioAlbum(Request $request){

        // Query series of audio type #2
        $playlists = PlaylistSerie::where('mediatype_id', '2')
                                    ->orderBy('created_at', 'desc')
                                    ->with('category')
                                    ->paginate(15);

        return view('admin.serie.index')->with([
            'playlists' => $playlists
        ]);
    }
}
