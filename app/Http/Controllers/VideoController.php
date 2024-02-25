<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Gcategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $category= Gcategory::all();
        $video= Video::OrderBy('id',"DESC")->paginate(10);
        
        return view('admin.video')->with('video',$video)->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Gcategory::all();
        return view('admin.create_video')->with('category',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $video= new Video();
     
        $video->ylink = $request->input('ylink');
        $video->gcat_id = $request->input('Category');
        $video->user =\Auth::user()->name;
        // Check if a profile image has been uploaded
        if ($request->has('video')) {
            // Get image file
            $image = $request->file('video');
            // Make a image name based on user name and current timestamp
            $name = "BPSA_video".'_'.time();
            // Define folder path
            // $folder = '/assets/admin_writer/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            // $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $request->video->move(('uploads/video/'), $filePath);
            $video->video = \URL::to('/uploads/video/').'/'.$filePath;
        }
        // Persist user record to database
        $video->save();

        // Return user back and show a flash message
        return back()->with(['status' => 'Video upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category= Gcategory::all();
        $video =Video::find($id);
        return view('admin.edit_video')->with('video',$video)->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

        $video=  Video::find($request->input('id'));
        $video->ylink = $request->input('ylink');
        $video->user = \Auth::user()->name;
        $video->gcat_id = $request->input('Category');
        // Check if a profile image has been uploaded
        if ($request->has('video')) {
            // Get image file
            $image = $request->file('video');
            // Make a image name based on user name and current timestamp
            $name = "BPSA_video".'_'.time();
            // Define folder path
            // $folder = '/assets/admin_writer/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            // $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $request->video->move(('uploads/video/'), $filePath);
            $video->video = \URL::to('/uploads/video/').'/'.$filePath;
        }
        // Persist user record to database
        $video->save();

        // Return user back and show a flash message
        return back()->with(['status' => 'Video update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Video::find($id);
        $files= $file->image;
        // dd($files);
        $filename = 'uploads/video/'.$files;
        \File::delete($filename);
        if(Video::destroy($id)){
       
            return back()->with(['status' => 'Video Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    
      public function innotice($id)
    {
        $file=Video::find($id);
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' video is inactive successfully.']);
        
    }
    
     public function acnotice($id)
    {
        $file=Video::find($id);
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'video is active successfully.']);
        
    }
}
