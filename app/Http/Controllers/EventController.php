<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image= Event::OrderBy('id','DESC')->get();
        // dd($image);
        return view('admin.event')->with('images',$image);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $event= new Event();
        $event->user = \Auth::user()->name;
        $event->title = $request->input('title');
        $event->time = $request->input('time');
        $event->start_date = $request->input('start_date');
        
        $event->date = $request->input('date');
        $event->description = $request->input('description');
        $event->events = $request->input('events');
        $event->vedio_link = $request->input('vlink');
       
        
        if($request->file('image')){
            $image = $request->file('image');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $event->image= $imageUrl;
            // $file= $request->file('image');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/event'), $filename);
            // $event->image= \URL::to('/uploads/event/').'/'.$filename;
        }

	 $event->save();
        // Return user back and show a flash message
    return back()->with(['status' => 'Event upload successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        
        $event=  Event::where('id',$request->id)->first();
       // dd($event);
        $b_event=\DB::table('back_events')->insert([
            'event_id'=>$event->id,
            'user'=>$event->user,
            'time'=>$event->time,
            'date'=>$event->date,
            'title'=>$event->title,
            'description'=>$event->description,
            'events'=>$event->events,
            'vedio_link'=>$event->vedio_link,
            'image'=>$event->image,
            ]);
        
        
        
        $event->user = \Auth::user()->name;
        $event->title = $request->input('title');
        $event->description = $request->input('description');
         $event->time = $request->input('time');
         $event->date = $request->input('date');
          $event->start_date = $request->input('start_date');
        $event->events = $request->input('events');
        $event->vedio_link = $request->input('vlink');
       
        
        if($request->file('image')){
            $image = $request->file('image');
            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');        
            $imageUrl = $response['data']['url'];
            $event->image= $imageUrl;
            // $file= $request->file('image');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/event'), $filename);
            // $event->image= \URL::to('/uploads/event/').'/'.$filename;
        }

	 $event->save();
        // Return user back and show a flash message
    return back()->with(['status' => 'Event Update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Event::find($id);
      
        if(Event::destroy($id)){
       
            return redirect('admin/event')->with(['status' => 'Event Delete successfully.']);
        }
        else{
            return redirect('admin/event')->with(['status' => 'Someting is wrong.']);
        }
    }
}
