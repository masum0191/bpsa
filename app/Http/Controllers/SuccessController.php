<?php

namespace App\Http\Controllers;

use App\Models\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class SuccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $massege= Success::OrderBy('id','DESC')->get();
        return view('admin.successe')->with('massege',$massege);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
     
        return view('admin.create_successe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        $slider= new Success();
        
        $slider->title = $request->input('title');
        $slider->note = $request->input('note');
        $slider->user = \Auth::user()->name;
        
        if($request->file('photo')){
            $image = $request->file('photo');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $slider->image= $imageUrl;
            // $file= $request->file('photo');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/success'), $filename);
            // $slider->image= \URL::to('/uploads/success/').'/'.$filename;
        }

	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Success upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Success  $success
     * @return \Illuminate\Http\Response
     */
    public function show(Success $success)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Success  $success
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        
        $massege=Success::where('id',$id)->first();
        return view('admin.edit_successe')->with('massege',$massege);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Success  $success
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $massege= Success::where('id',$request->input('id'))->first();
        
        $massege->title = $request->input('title');
        $massege->note = $request->input('note');
       $massege->user =\Auth::user()->name;
        
       if($request->file('photo')){
        $image = $request->file('photo');
        $response = Http::attach(
            'image', file_get_contents($image), $image->getClientOriginalName()
        )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
        $imageUrl = $response['data']['url'];
        $slider->image= $imageUrl;
        // $file= $request->file('photo');
        // $filename= date('YmdHi').$file->getClientOriginalName();
        // $file-> move(public_path('uploads/success'), $filename);
        // $slider->image= \URL::to('/uploads/success/').'/'.$filename;
    }
	    $massege->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Success Update successfully.']);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Success  $success
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $file=Success::find($id);
       $files= $file->image;
        // dd($files);
        $filename = 'uploads/success/'.$files;
        \File::delete($filename);
        if(Success::destroy($id)){
       
            return back()->with(['status' => 'Success Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    
     public function innotice($id)
    {
        $file=Success::find($id);
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' Success is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Success::find($id);
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'Success is active successfully.']);
        
    }
}
