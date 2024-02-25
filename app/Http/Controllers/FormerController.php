<?php

namespace App\Http\Controllers;

use App\Models\Former;
use Illuminate\Http\Request;

class FormerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $former= Former::OrderBy('Session','DESC')->get();
        return view('admin.former')->with('former',$former);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
    {
       
       return view('admin.create_former');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
     
        $former= new Former();
        $former->Session = $request->input('Session');
        $former->user = \Auth::user()->name;
        $former->President_Name = $request->input('President_Name');
        $former->President_Designation = $request->input('President_Designation');
        $former->Secretary_Designation = $request->input('Secretary_Designation');
        $former->Secretary_Name = $request->input('Secretary_Name');
       
        
        if($request->file('President_Image')){
            $file= $request->file('President_Image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/former'), $filename);
            $former->President_Image= \URL::to('/uploads/former/').'/'.$filename;
        }
        if($request->file('Secretary_Image')){
            $file= $request->file('Secretary_Image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/former'), $filename);
            $former->Secretary_Image= \URL::to('/uploads/former/').'/'.$filename;
        }
        
        
	    $former->save();
        // Return user back and show a flash message
        return redirect('admin/former/create')->with(['status' => 'Former upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Former  $former
     * @return \Illuminate\Http\Response
     */
    public function show(Former $former)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Former  $former
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $former=Former::where('id',$id)->first();
       return view('admin.edit_former')->with('former',$former);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Former  $former
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
    {
       
       $former=  Former::find($request->input('id'));
       $former->user = \Auth::user()->name;
       $former->Session = $request->input('Session');
        $former->President_Name = $request->input('President_Name');
        $former->President_Designation = $request->input('President_Designation');
        $former->Secretary_Designation = $request->input('Secretary_Designation');
        $former->Secretary_Name = $request->input('Secretary_Name');
       
        
        if($request->file('President_Image')){
            $file= $request->file('President_Image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/former'), $filename);
            $former->President_Image= \URL::to('/uploads/former/').'/'.$filename;
        }
        if($request->file('Secretary_Image')){
            $file= $request->file('Secretary_Image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/former'), $filename);
            $former->Secretary_Image= \URL::to('/uploads/former/').'/'.$filename;
        }
	 $former->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Former Update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Former  $former
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $file=Former::find($id);
      
        if(Former::destroy($id)){
       
            return back()->with(['status' => 'Former Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
     public function innotice($id)
    {
        $file=Former::find($id);
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' Former is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Former::find($id);
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'Notice is active successfully.']);
        
    }
}
