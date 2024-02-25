<?php

namespace App\Http\Controllers;

use App\Models\Massege;
use Illuminate\Http\Request;

class MassegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $massege= Massege::OrderBy('session','DESC')->get();
        return view('admin.massege')->with('massege',$massege);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('admin.create_massege');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider= new Massege();
        
        $slider->name = $request->input('name');
         $slider->user =\Auth::user()->name;
         $slider->session = $request->input('session');
        $slider->Official_designation = $request->input('Official_designation');
        $slider->BPSA_Designation = $request->input('BPSA_Designation');
        $slider->note = $request->input('note');
       
        
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/massege'), $filename);
            $slider->photo= \URL::to('/uploads/massege/').'/'.$filename;
        }

	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Massege upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Massege  $massege
     * @return \Illuminate\Http\Response
     */
    public function show(Massege $massege)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Massege  $massege
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $massege=Massege::where('id',$id)->first();
        return view('admin.edit_massege')->with('massege',$massege);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Massege  $massege
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request)
    {
        
        $massege= Massege::where('id',$request->input('id'))->first();
        $massege->user =\Auth::user()->name;
        $massege->session = $request->input('session');
        $massege->name = $request->input('name');
        $massege->note = $request->input('note');
        $massege->Official_designation = $request->input('Official_designation');
        $massege->BPSA_Designation = $request->input('BPSA_Designation');
        
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/massege'), $filename);
            $massege->photo= \URL::to('/uploads/massege/').'/'.$filename;
        }
	    $massege->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Massege Update successfully.']);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Massege  $massege
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Massege::find($id);
       $files= $file->photo;
        // dd($files);
        $filename = 'uploads/massege/'.$files;
        \File::delete($filename);
        if(Massege::destroy($id)){
       
            return back()->with(['status' => 'Massege Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    
     public function innotice($id)
    {
        $file=Massege::find($id);
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' Massege is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Massege::find($id);
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'Massege is active successfully.']);
        
    }
}
