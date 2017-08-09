<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\File;
use App\Models\FileEntry;
use Response;
use Auth;
use Storage;
use Validator;
use Session;
use Exception;

class FileController extends Controller
{

    public function index(){
        $files = FileEntry::orderBy('created_at','desc')->paginate(15);
        return view('admin.files.file_index')->with(['files' => $files]);
    }

    public function previewSound(Request $request, $id){
        try{
            $sound = FileEntry::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return Response::make(null, 404, null);
        }

        $exist = $this->isFileExist($sound->location_url, $sound->disk);
        if($exist){
            $fileurl = Storage::disk($sound->disk)->get($sound->location_url);
            echo dd($fileurl);
            $headers = array(
                'Content-type' => $sound->mime,
            );
            return Response::make( file_get_contents($fileurl), 200, $headers);
        }else{
            return Response::make(null, 500, null);
        }

    }

    public function store(Request $request, $disk){
        if($request->ajax()){
            $v = Validator::make(
                $request->all(),
                [
                    'sound_file' => 'required',
                    'path' => 'required|min:1'
                ]
            );

            if($v->fails()){
                dd($v->errors());
                return response()->json(['errordd' => $v->errors()]);
            }
            $file = $request->file('sound_file');
            $soundFolder = $request->input('path');

            $result = $this->uploadFile($disk, $file, $soundFolder);
            return response()->json($result);
        }

        return redirect()->back();
    }

    private function uploadFile($disk, $file, $folder){
        $fileName = $this->generateHashName($file);
        $filePath = $file->path();
        $extension = $file->getClientOriginalExtension();
        $uploadPath = $folder . date("Y") . '/' . date("m") . "/";
        $exist = $this->isFileExist($uploadPath.$fileName.'.'.$extension, $disk);

        if($exist){
            $fileName = $this->generateHashName($file);
            $fileName = time().$fileName;
        }
        try{
            Storage::disk($disk)->putFileAs($uploadPath, new File($filePath), $fileName.'.'.$extension);
        }catch(Exception $e){
            return [
                'status' => 400,
                'error' => [
                    'code' => 400,
                    'message' => 'Error occured while uploading file to cloud'
                ],
            ];
        }

        try{
            $entry = new FileEntry();
            $entry->mime = $file->getClientMimeType();
            $entry->location_url = $uploadPath.$fileName.'.'.$extension;
            $entry->filename = $fileName.'.'.$extension;
            $entry->original_filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $entry->extension = $extension;
            $entry->disk = $disk;
            $entry->createdBy()->associate(Auth::user());
            $entry->save();
        }catch(Exception $e){
            return [
                'status' => 402,
                'error' => [
                    'code' => 402,
                    'message' => 'file successfully uploaded, but failed to registered file entry'
                ],
            ];
        }

        return [
            'status' => 200,
            'data' => $entry->toArray(),
            'success' => [
                'code' => 200,
                'message' => 'Successfully uploaded file and registered new file entry'
            ],
        ];

    }
    // Generate hash file name
    private function generateHashName($file){
        $fileName = $file->hashName();
        return $fileName;
    }

    // Check if disk exist file
    private function isFileExist($file_path, $disk){
        $exist = Storage::disk($disk)->exists($file_path);
        return $exist;
    }
}
