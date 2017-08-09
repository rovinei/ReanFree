<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\PlaylistSerie;
use App\Models\User;
use App\Models\Admin;
use App\Models\FileEntry;
use App\Models\Department;
use DB;
use Exception;

class DashboardController extends Controller
{

    public function index(){

        $articlesCount = Post::where('mediatype_id', '=', 1)->count();
        $soundsCount = Post::where('mediatype_id', '=', 2)->count();
        $videosCount = Post::where('mediatype_id', '=', 3)->count();
        $categoriesCount = Category::all()->count();
        $tagsCount = DB::table('tagging_tags')->count();
        $seriesCount = PlaylistSerie::all()->count();
        $usersCount = User::all()->count();
        $staffsCount = Admin::all()->count();
        $departmentsCount = Department::all()->count();
        $filesCount = FileEntry::all()->count();
        return view('admin.dashboard')->with([
            'articlesCount' => $articlesCount,
            'soundsCount' => $soundsCount,
            'videosCount' => $videosCount,
            'categoriesCount' => $categoriesCount,
            'seriesCount' => $seriesCount,
            'usersCount' => $usersCount,
            'staffsCount' => $staffsCount,
            'departmentsCount' => $departmentsCount,
            'tagsCount' => $tagsCount,
            'filesCount' => $filesCount
        ]);
    }

}
