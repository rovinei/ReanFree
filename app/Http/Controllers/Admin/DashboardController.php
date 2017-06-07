<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\MediaType;
use App\Models\Category;
use App\Models\PlaylistSerie;
use App\Models\User;
use App\Models\Admin;
use App\Models\FileEntry;
use App\Models\Department;
use DB;

class DashboardController extends Controller
{

    public function index(){

        $mediaTypes = MediaType::all();
        $articleType = $mediaTypes->where('name', '=', 'reading')->first();
        $soundType = $mediaTypes->where('name', '=', 'listening')->first();
        $videoType = $mediaTypes->where('name', '=', 'watching')->first();

        $mediaTypesCount = $mediaTypes->count();
        $articlesCount = $articleType->posts()->count();
        $soundsCount = $soundType->posts()->count();
        $videosCount = $videoType->posts()->count();
        $categoriesCount = Category::count();
        $tagsCount = DB::table('tagging_tags')->count();
        $seriesCount = PlaylistSerie::count();
        $usersCount = User::count();
        $staffsCount = Admin::count();
        $departmentsCount = Department::count();
        $filesCount = FileEntry::count();
        return view('admin.dashboard')->with([
            'articlesCount' => $articlesCount,
            'soundsCount' => $soundsCount,
            'videosCount' => $videosCount,
            'categoriesCount' => $categoriesCount,
            'seriesCount' => $seriesCount,
            'usersCount' => $usersCount,
            'staffsCount' => $staffsCount,
            'departmentsCount' => $departmentsCount,
            'mediaTypesCount' => $mediaTypesCount,
            'tagsCount' => $tagsCount,
            'filesCount' => $filesCount
        ]);
    }

}
