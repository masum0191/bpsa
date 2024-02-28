<?php

namespace App\Http\Controllers;

use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class LeadershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $massege= Leadership::OrderBy('session','DESC')->get();
        return view('admin.leadership')->with('massege',$massege);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
     
        return view('admin.create_leadership');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider= new Leadership();
        
        $slider->session = $request->input('session');
        $slider->name = $request->input('name');
        $slider->user = \Auth::user()->name;
        $slider->Official_designation = $request->input('Official_designation');
        $slider->BPSA_Designation = $request->input('BPSA_Designation');
        $slider->note = $request->input('note');
       
        
        if($request->file('photo')){
            $image = $request->file('photo');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $slider->photo= $imageUrl;
            // $file= $request->file('photo');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/leadership'), $filename);
            // $slider->photo= \URL::to('/uploads/leadership/').'/'.$filename;
        }

	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Leadership upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leadership  $leadership
     * @return \Illuminate\Http\Response
     */
    public function show(Leadership $leadership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leadership  $leadership
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        
        $massege=Leadership::where('id',$id)->first();
        return view('admin.edit_leadership')->with('massege',$massege);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leadership  $leadership
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
    {
        
        $massege= Leadership::where('id',$request->input('id'))->first();
        
        $massege->session = $request->input('session');
        $massege->name = $request->input('name');
        $massege->user =\Auth::user()->name;
        $massege->note = $request->input('note');
        $massege->Official_designation = $request->input('Official_designation');
        $massege->BPSA_Designation = $request->input('BPSA_Designation');
        
        if($request->file('photo')){
            $image = $request->file('photo');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $slider->photo= $imageUrl;
            // $file= $request->file('photo');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/leadership'), $filename);
            // $slider->photo= \URL::to('/uploads/leadership/').'/'.$filename;
        }
	    $massege->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Leadership Update successfully.']);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leadership  $leadership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Leadership::find($id);
       $files= $file->photo;
        // dd($files);
        $filename = 'uploads/leadership/'.$files;
        \File::delete($filename);
        if(Leadership::destroy($id)){
       
            return back()->with(['status' => 'Leadership Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
     public function innotice($id)
    {
        $file=Leadership::find($id);
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' Leadership is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Leadership::find($id);
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'Leadership is active successfully.']);
        
    }
}
