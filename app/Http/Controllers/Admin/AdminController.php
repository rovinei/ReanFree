<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Admin;
use Session;
use Auth;
use Exception;

class AdminController extends Controller
{

    public function index(){

        // Query all author user
        $authors = Admin::orderBy('username')
                        ->paginate(20);

        return view('admin.author.index')->with(['authors' => $authors]);
    }

    public function create(){

        // Return register form
        return view('admin.author.register_author');
    }

    public function store(Request $request){

        // Validate
        $this->validate($request, [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'username' => 'required|min:3',
            'email' => 'required|email|min:3',
            'password' => 'required|min:5'
        ]);

        // Store author
        try {
            $author = new Admin($request->all());
            $author->password = bcrypt($request->password);
            $author->save();
        } catch (Exception $e) {
            Session::flash('error_message', 'Error while register author, please try again');
            return redirect()->back();
        }

        Session::flash('success_message', 'successfully registerd new author.');
        return redirect()->back();
    }

    public function manageAuthor(Request $request, $author_id){

        // Find author by id
        try {
            $author = Admin::findOrFail($author_id);

        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find author by id :'.$author_id);
        }
    }

    /**
     * Funtion edit()
     * @return author updation form
     *
    */
    public function edit(Request $request, $author_id){

        // Find author by id
        try {
            $author = Admin::findOrFail($author_id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find author by id : '.$author_id);
            return redirect()->back();
        }
        // Return updation form
        return view('admin.author.update_author')->with(['author', $author]);
    }

    /**
     * Funtion update()
     * @return author update request
     *
    */
    public function update(Request $request, $author_id){

        // Validate form data
        $this->validate($request, [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'username' => 'required|min:3',
            'email' => 'required|email|min:3',
        ]);

        // Determine if author existed
        try {
            $author = Admin::findOrFail($author_id);
            $author->update($request->all());
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find author by id : '.$author_id);
            return redirect()->back();
        } catch(Exception $e){
            Session::flash('error_message', 'Oop! something went wrong, please try again.');
            return redirect()->back();
        }

        // Return request back
        Session::flash('success_message', 'Successfully updated author');
        return redirect()->back();
    }

    /**
     * Funtion destroy()
     * @return remove author
     *
    */
    public function destroy(Request $request, $author_id){

        // Find author by id
        try {
            $author = Admin::findOrFail($author_id);
            $author->delete();
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Cannot find author by id :'.$author_id);
            return redirect()->back();
        } catch(Exception $e){
            Session::flash('error_message', 'Oop! something went wrong, please try again.');
            return redirect()->back();
        }

        // Return request back
        Session::flash('success_message', 'Successfully removed author.');
        return redirect()->back();
    }
}
