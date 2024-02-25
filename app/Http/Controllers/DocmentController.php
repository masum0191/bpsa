<?php

namespace App\Http\Controllers;

use App\Models\Docment;
use Illuminate\Http\Request;

class DocmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $docment= Docment::OrderBy('id','DESC')->get();
        return view('admin.docment')->with('docment',$docment);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       return view('admin.create_docment');
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
            'title'  =>  'required',
        ]);
        $docment= new Docment();
        $docment->user =\Auth::user()->name;
        $docment->title = $request->input('title');
        $docment->summary = $request->input('summary');
       
        if($request->file('c_photo')){
            $file= $request->file('c_photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/documant'), $filename);
            $docment->c_photo= \URL::to('/uploads/documant/').'/'.$filename;
        }
        if($request->file('file')){
            $file= $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/documant'), $filename);
            $docment->file= \URL::to('/uploads/documant/').'/'.$filename;
        }
       
	    $docment->save();
        // Return user back and show a flash message
        return redirect('admin/docment/create')->with(['status' => 'Document upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docment  $docment
     * @return \Illuminate\Http\Response
     */
    public function show(Docment $docment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docment  $docment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $docment=Docment::where('id',$id)->first();
       return view('admin.edit_docment')->with('docment',$docment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docment  $docment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        
        $request->validate([
            'title'              =>  'required',
        ]);
        $docment= Docment::where('id',$request->input('id'))->first();
        $docment->title = $request->input('title');
        $docment->summary = $request->input('summary');
        $docment->user = \Auth::user()->name;
        if($request->file('c_photo')){
            $file= $request->file('c_photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/documant'), $filename);
            $docment->c_photo= \URL::to('/uploads/documant/').'/'.$filename;
        }
        if($request->file('file')){
            $file= $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/documant'), $filename);
            $docment->file= \URL::to('/uploads/documant/').'/'.$filename;
        }
       
	    $docment->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Document Update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docment  $docment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=docment::find($id);
      
        if(Docment::destroy($id)){
       
            return redirect('admin/docment')->with(['status' => 'Document Delete successfully.']);
        }
        else{
            return redirect('admin/docment')->with(['status' => 'Someting is wrong.']);
        }
    }
    public function innotice($id)
    {
        $file=Post::find($id);
        $file->notice=2;
        $file->save();
        return redirect('admin/post')->with(['status' => ' Notice is inactive successfully.']);
        
    }
    public function acnotice($id)
    {
        $file=Post::find($id);
        $file->notice=1;
        $file->save();
        return redirect('admin/post')->with(['status' => 'Notice is active successfully.']);
        
    }
}
