<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Gcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $category= Gcategory::all();
        $image= Gallery::OrderBy('id','DESC')->get();
        return view('admin.gallery')->with('images',$image)->with('category',$category);
    }
   public function windex()
    {  $category= Gcategory::all();
        $image= Gallery::OrderBy('id','DESC')->paginate(10);
        return view('writer.gallery')->with('images',$image)->with('category',$category);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Gcategory::all();
        return view('admin.create_gallery')->with('category',$category);
    }
    public function wcreate()
    {
        $category= Gcategory::all();
        return view('writer.create_gallery')->with('category',$category);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $slider= new Gallery();
        $slider->gcat_id = $request->input('Category');
         $slider->user = \Auth::user()->name;
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
       
        
        if($request->file('image')){
            $image = $request->file('image');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $slider->image= $imageUrl;
            // $file= $request->file('image');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/gallery'), $filename);
            // $slider->image= \URL::to('/uploads/gallery/').'/'.$filename;
        }

	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Gallery upload successfully.']);
   
    }
    public function wstore(Request $request)
    {
        
        
        $slider= new Gallery();
        $slider->gcat_id = $request->input('Category');
         $slider->user = \Auth::user()->name;
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
       
        
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/gallery'), $filename);
            $slider->image= \URL::to('/uploads/gallery/').'/'.$filename;
        }

	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Gallery upload successfully.']);
   
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= Gcategory::all();
        $post=Gallery::where('id',$id)->first();
        return view('admin.edit_gallery')->with('category',$category)->with('post',$post);

    }
    public function wedit($id)
    {
        $category= Gcategory::all();
        $post=Gallery::where('id',$id)->first();
        return view('writer.edit_gallery')->with('category',$category)->with('post',$post);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $slider= Gallery::where('id',$request->input('id'))->first();
        $slider->gcat_id = $request->input('Category');
        $slider->user =  \Auth::user()->name;
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
       
        
        if($request->file('image')){
            $image = $request->file('image');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $slider->image= $imageUrl;
            // $file= $request->file('image');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/gallery'), $filename);
            // $slider->image= \URL::to('/uploads/gallery/').'/'.$filename;
        }
	    $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Gallery Update successfully.']);
   
    }
     public function wupdate(Request $request)
    {
        
        $slider= Gallery::where('id',$request->input('id'))->first();
        $slider->gcat_id = $request->input('Category');
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
       $slider->user =\Auth::user()->name;
        
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/gallery'), $filename);
            $slider->image= \URL::to('/uploads/gallery/').'/'.$filename;
        }
	    $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Gallery Update successfully.']);
   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Gallery::find($id);
      
        if(Gallery::destroy($id)){
       
            return back()->with(['status' => 'Gallery Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    public function wdestroy($id)
    {
        $file=Gallery::find($id);
      
        if(Gallery::destroy($id)){
       
            return back()->with(['status' => 'Gallery Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    
     public function innotice($id)
    {
        $file=Gallery::find($id);
        $file->home_page=2;
        $file->save();
        return back()->with(['status' => ' Gallery is inactive successfully.']);
        
    }
    
     public function winnotice($id)
    {
        $file=Gallery::find($id);
        $file->home_page=2;
        $file->save(); 
        return back()->with(['status' => ' Gallery is inactive successfully.']);
        
    }
     public function acnotice($id)
    {
        $file=Gallery::find($id);
        $file->home_page=1;
        $file->save();
        return back()->with(['status' => 'Gallery is active successfully.']);
        
    }
    public function wacnotice($id)
    {
        $file=Gallery::find($id);
        $file->home_page=1;
        $file->save();
        return back()->with(['status' => 'Gallery is active successfully.']);
        
    }
}
