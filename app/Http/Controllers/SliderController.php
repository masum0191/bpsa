<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image= slider::OrderBy('id','DESC')->get();
        // dd($image);
        return view('admin.slider')->with('images',$image);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_slider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              =>  'required',
            'image'     =>  '|image|mimes:jpeg,png,,PNG,jpg,gif|max:2048,required',
            'description'  =>  'required'
        ]);
// dd($request->image);
        // Get current user
        // $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $slider= new slider();
        $slider->title = $request->input('title');
         $slider->user = \Auth::user()->name;
        $slider->description = $request->input('description');

        // Check if a profile image has been uploaded
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/slider'), $filename);
            $slider->image= \URL::to('/uploads/slider/').'/'.$filename;
        }
        // Persist user record to database
        $slider->save();

        // Return user back and show a flash message
        return redirect('admin/slider')->with(['status' => 'Slider upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slideshow =slider::find($id);
        dd($slideshow);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slideshow =slider::find($id);
        return view('admin.edit_slider')->with('sliders',$slideshow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'              =>  'required',
            'image'     =>  '|image|mimes:jpeg,png,,PNG,jpg,gif|max:4048,required',
            'description'  =>  'required'
        ]);
// dd($request->image);
        // Get current user
        // $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $slider=  slider::find($request->input('id'));
        $slider->user =\Auth::user()->name;
        // dd($slider);
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/slider'), $filename);
            $slider->image= \URL::to('/uploads/slider/').'/'.$filename;
        }
        // Check if a profile image has been uploaded
        
        // Persist user record to database
        $slider->save();

        // Return user back and show a flash message
        return redirect('admin/slider')->with(['status' => 'Slider update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $file=slider::find($id);
        $files= $file->image;
        // dd($files);
        $filename = 'uploads/slider/'.$files;
        \File::delete($filename);
        if(Slider::destroy($id)){
       
            return redirect('admin/slider')->with(['status' => 'Slider Delete successfully.']);
        }
        else{
            return redirect('admin/slider')->with(['status' => 'Someting is wrong.']);
        }
    }

    public function innotice($id)
    {
        $file=Slider::find($id);
        $file->status=2;
        $file->save();
        return redirect('admin/slider')->with(['status' => ' Slider is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Slider::find($id);
        $file->status=1;
        $file->save();
        return redirect('admin/slider')->with(['status' => 'Slider is active successfully.']);
        
    }
}
