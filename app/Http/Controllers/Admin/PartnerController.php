<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Partner;
use Session;
use Auth;
use Exception;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // Query list of partners
        try {
            $partners = Partner::orderBy('created_at', 'desc')->paginate(20);
        } catch (Exception $e) {
            Session::flash('error_message', 'Oop! something went wrong, please try again');
            return redirect()->back();
        }

        return view('admin.partner.index')->with(['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'company_name' => 'required|min:3',
            'external_url' => 'required|min:5',
            'logo_src' => 'required|min:15',
            'status' => 'required|numeric|min:1'
        ]);

        try {
            $partner = new Partner($request->all());
            if($request->has('is_featured')){
                $partner->is_featured = 1;
            }else{
                $partner->is_featured = 0;
            }

            $partner->createdBy()->associate(Auth::user());
            $partner->save();
        } catch (Exception $e) {
            Session::flash('error_message', 'Opp! something went wrong, please try agian.');
            return redirect()->back();
        }

        Session::flash('success_message', 'Successfully created partner');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $partner_id)
    {
        // Determine if partner existed
        try {
            $partner = Partner::findOrFail($partner_id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Oop! cannot find partner by id :'.$partner_id);
            return redirect()->back();
        }

        return view('admin.partner.update')->with(['partner' => $partner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $partner_id)
    {
        // Validate form data
        $this->validate($request, [
            'company_name' => 'required|min:3',
            'external_url' => 'required|min:5',
            'logo_src' => 'required|min:15',
            'status' => 'required|numeric|min:1'
        ]);

        try {
            $partner = Partner::findOrFail($partner_id);
            if($request->has('is_featured')){
                $partner->is_featured = 1;
            }else{
                $partner->is_featured = 0;
            }
            $partner->updatedBy()->associate(Auth::user());
            $partner->update($request->all());
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Oop! cannot find partner by id :'.$partner_id);
            return redirect()->back();
        } catch(Exception $e){
            Session::flash('error_message', 'Oop! something went wrong, please try again.');
            return redirect()->back();
        }

        Session::flash('success_message', 'Successfully updated partner.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
