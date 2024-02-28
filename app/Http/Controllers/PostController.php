<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $category= Category::all();
        $image= Post::OrderBy('id','DESC')->get();
        return view('admin.post')->with('images',$image)->with('category',$category);
    }
     public function windex()
    {   $category= Category::all();
        $image= Post::OrderBy('id','DESC')->paginate(10);
        return view('writer.post')->with('images',$image)->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $category= Category::all();
       return view('admin.create_post')->with('category',$category);
    }
   public function wcreate()
    {
       $category= Category::all();
       return view('writer.create_post')->with('category',$category);
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
            'Heading'              =>  'required',
            //'Cover_Photo' => 'required|Cover_Photo|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $slider= new Post();
        $slider->user = \Auth::user()->name;
        $slider->Category = $request->input('Category');
        $slider->Heading = $request->input('Heading');
        $slider->Sub_Heading = $request->input('Sub_Heading');
        $slider->Start_Date = $request->input('Start_Date');
        $slider->End_Date = $request->input('End_Date');
        $slider->Details = $request->input('Details');
        
        if($request->file('Cover_Photo')){         
            
           
           
    $image = $request->file('Cover_Photo');

    $response = Http::attach(
        'image', file_get_contents($image), $image->getClientOriginalName()
    )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');

    $imageUrl = $response['data']['url'];

    //return $imageUrl;


            // $response = Http::post('https://api.imgbb.com/1/upload', [
            //     'expiration' => 600,
            //     'key' => '01d3eafd9fb565419fba52e1e14a7d5a',
            //     'image' => base64_encode(file_get_contents($file->path())),
            // ]);    
            // // Decode the JSON response
            // $data = $response->json();
            // dd($data);
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/post'), $filename);
            $slider->Cover_Photo= $imageUrl;
            
        }
        if($request->file('Document_Link')){
    $image = $request->file('Document_Link');

    $response = Http::attach(
        'image', file_get_contents($image), $image->getClientOriginalName()
    )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');

    $imageUrl = $response['data']['url'];

    //return $imageUrl;
            // $file= $request->file('Document_Link');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            // $file-> move(public_path('uploads/post'), $filename);
            // $slider->Document_Link= \URL::to('/uploads/post/').'/'.$filename;
            $slider->Document_Link= $imageUrl;
        }
        
        if($request->hasfile('gimage')){       


        $data=array();
        // dd($request->hasfile('gimage'));
        // if($request->file('gimage'))
        // {
    $client = new Client();    
    $images = $request->file('gimage');    
    foreach ($images as $image) {
        $response = $client->request('POST', 'https://api.imgbb.com/1/upload', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($image->getPathname(), 'r'),
                    'filename' => $image->getClientOriginalName()
                ],
                [
                    'name' => 'key',
                    'contents' => '01d3eafd9fb565419fba52e1e14a7d5a'
                ]
            ]
        ]);
       $imgbbResponse = json_decode($response->getBody()->getContents());
       $data[] = $imgbbResponse->data->url;       
//}
        }
        $slider->gimage=json_encode($data); 
        }
	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Post Update successfully.']);
        // redirect('admin/post')->with(['status' => 'Post Update successfully.']);
    }
    public function edit($id)
    {
        $category= Category::all();
        $post=Post::where('id',$id)->first();
       return view('admin.edit_post')->with('category',$category)->with('post',$post);

    }
    public function wstore(Request $request)
    {
       
        $request->validate([
            'Heading'              =>  'required',
        ]);
        $slider= new Post();
        $slider->user = 'C-'.\Auth::user()->name;
        $slider->Category = $request->input('Category');
        $slider->Heading = $request->input('Heading');
        $slider->Sub_Heading = $request->input('Sub_Heading');
        $slider->Start_Date = $request->input('Start_Date');
        $slider->End_Date = $request->input('End_Date');
        $slider->Details = $request->input('Details');
        
        if($request->file('Cover_Photo')){
            $file= $request->file('Cover_Photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/post'), $filename);
            $slider->Cover_Photo= \URL::to('/uploads/post/').'/'.$filename;
        }
        if($request->file('Document_Link')){
            $file= $request->file('Document_Link');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/post'), $filename);
            $slider->Document_Link= \URL::to('/uploads/post/').'/'.$filename;
        }
        // Persist user record to database
        $data=array();
        // dd($request->hasfile('gimage'));
        if($request->file('gimage'))
        {
           foreach($request->file('gimage') as $file)
           {

            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/post'), $filename);
            
            $data[] =$filename; 
            
              
       }
        }
        $slider->gimage=json_encode($data); 
	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Post upload successfully.']);
    }

    public function update(Request $request)
    {
       
   
        $request->validate([
            'Heading'              =>  'required',
        ]);
        $slider= Post::where('id',$request->input('id'))->first();
        
          $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$slider->id,
            'type'=>"update",
            'Pub_Date'=>$slider->Pub_Date,
            'Category'=>$slider->Category,
            'Heading'=>$slider->Heading,
            'Sub_Heading'=>$slider->Sub_Heading,
            'Start_Date'=>$slider->Start_Date,
            'End_Date'=>$slider->End_Date,
            'Details'=>$slider->Details,
            'Cover_Photo'=>$slider->Cover_Photo,
            
            'status'=>$slider->status,
            'Document_Link'=>$slider->Document_Link,
            'gimage'=>$slider->gimage,
            'notice'=>$slider->notice,
            'highlight'=>$slider->highlight,
            'user'=>$slider->user,
            ]);
        
        $slider->user =\Auth::user()->name;
        $slider->Category = $request->input('Category');
        $slider->Heading = $request->input('Heading');
        $slider->Sub_Heading = $request->input('Sub_Heading');
        $slider->Start_Date = $request->input('Start_Date');
        $slider->End_Date = $request->input('End_Date');
        $slider->Details = $request->input('Details');
        
        if($request->file('Cover_Photo')){
           
            $image = $request->file('Cover_Photo');

            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');
        
            $imageUrl = $response['data']['url'];      
        
         $slider->Cover_Photo= $imageUrl;

        }
        if($request->file('Document_Link')){
            $image = $request->file('Document_Link');

            $response = Http::attach(
                'image', file_get_contents($image), $image->getClientOriginalName()
            )->post('https://api.imgbb.com/1/upload?key=01d3eafd9fb565419fba52e1e14a7d5a');
        
            $imageUrl = $response['data']['url'];
            $slider->Document_Link= $imageUrl;
        }
        // Persist user record to database
        if($request->hasfile('gimage')){
        $data=array();
        
    $client = new Client();    
    $images = $request->file('gimage');    
    foreach ($images as $image) {
        $response = $client->request('POST', 'https://api.imgbb.com/1/upload', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($image->getPathname(), 'r'),
                    'filename' => $image->getClientOriginalName()
                ],
                [
                    'name' => 'key',
                    'contents' => '01d3eafd9fb565419fba52e1e14a7d5a'
                ]
            ]
        ]);
       $imgbbResponse = json_decode($response->getBody()->getContents());
       $data[] = $imgbbResponse->data->url;       
            
              
       }
        
        $slider->gimage=json_encode($data); 
        }
	 $slider->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Post Update successfully.']);
        // redirect('admin/post')->with(['status' => 'Post Update successfully.']);
    }
      public function wupdate(Request $request)
        {
           
            
            $request->validate([
                'Heading'              =>  'required',
            ]);
            $slider= Post::where('id',$request->input('id'))->first();
             $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$slider->id,
            'type'=>"update",
            'Pub_Date'=>$slider->Pub_Date,
            'Category'=>$slider->Category,
            'Heading'=>$slider->Heading,
            'Sub_Heading'=>$slider->Sub_Heading,
            'Start_Date'=>$slider->Start_Date,
            'End_Date'=>$slider->End_Date,
            'Details'=>$slider->Details,
            'Cover_Photo'=>$slider->Cover_Photo,
            
            'status'=>$slider->status,
            'Document_Link'=>$slider->Document_Link,
            'gimage'=>$slider->gimage,
            'notice'=>$slider->notice,
            'highlight'=>$slider->highlight,
            'user'=>$slider->user,
            ]);
            $slider->Category = $request->input('Category');
            $slider->Heading = $request->input('Heading');
            $slider->Sub_Heading = $request->input('Sub_Heading');
            $slider->Start_Date = $request->input('Start_Date');
            $slider->End_Date = $request->input('End_Date');
            $slider->Details = $request->input('Details');
            $slider->user =  $slider->user. ','.' U-'.\Auth::user()->name;
            if($request->file('Cover_Photo')){
                $file= $request->file('Cover_Photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/post'), $filename);
                $slider->Cover_Photo= \URL::to('/uploads/post/').'/'.$filename;
            }
            if($request->file('Document_Link')){
                $file= $request->file('Document_Link');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/post'), $filename);
                $slider->Document_Link= \URL::to('/uploads/post/').'/'.$filename;
            }
            // Persist user record to database
            if($request->hasfile('gimage')){
            $data=array();
            // dd($request->hasfile('gimage'));
            if($request->file('gimage'))
            {
               foreach($request->file('gimage') as $file)
               {
    
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('uploads/post'), $filename);
                
                $data[] =$filename; 
                
                  
           }
            }
            $slider->gimage=json_encode($data); 
            }
    	 $slider->save();
            // Return user back and show a flash message
            return back()->with(['status' => 'Post Update successfully.']);
            // redirect('admin/post')->with(['status' => 'Post Update successfully.']);
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=Post::find($id);
         $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"delete",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->user =  \Auth::user()->name;
        $file->save();
        if(Post::destroy($id)){
       
            return back()->with(['status' => 'Post Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    public function wdestroy($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"delete",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->user =  \Auth::user()->name;
        $file->save();
        if(Post::destroy($id)){
       
            return back()->with(['status' => 'Post Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
    public function sinnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"status",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->status=2;
        $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => ' Status is inactive successfully.']);
        
    }
    
     public function sacnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"status",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->status=1;
        $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => 'Status is active successfully.']);
        
    }
     public function ninnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"status",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->notice=2;
        $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => ' Notice is inactive successfully.']);
        
    }
    
     public function nacnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"Highlight",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->notice=1;
        $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => 'Notice is active successfully.']);
        
    }
     public function hinnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"Highlight",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->highlight=2;
         $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => ' Highlight is inactive successfully.']);
        
    }
    
     public function hacnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"Highlight",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->highlight=1;
         $file->user =  \Auth::user()->name;
        $file->save();
        return back()->with(['status' => 'Highlight is active successfully.']);
        
    }
    public function publish(Request $request)
    {
        $file=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"publish",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
        $file->Pub_Date=$request->Pub_date;
         $file->user =  \Auth::user()->name;
        $file->Start_Date=$request->Pub_date;
        $file->save();
        return back()->with(['status' => 'Post is publish successfully.']);
        
    }
    public function remove(Request $request)
    {
     //dd($request);
        if($request->file=='cimage'){
        $remove=Post::find($request->id);
       $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
        $files= $remove->Cover_Photo;
        // dd($files);
        $filename = 'uploads/post/'.$files;
        \File::delete($filename);
            $remove->Cover_Photo="";
            $remove->save();
        }
        if($request->file=='Dimage'){
        $remove=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
        $files= $remove->Document_Link;
        // dd($files);
        $filename = 'uploads/post/'.$files;
        \File::delete($filename);
            $remove->Document_Link="";
            $remove->save();
        }
        if($request->file=='gimage'){
        $remove=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
            $remove->gimage="";
            $remove->save();
        }
        
        return back()->with(['status' => ' File Remove successfully.']);
        
    }
    
    
    public function wsinnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"status",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
             $file->user =  \Auth::user()->name;
        $file->status=2;
        $file->save();
        return back()->with(['status' => ' Status is inactive successfully.']);
        
    }
    
     public function wsacnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"status",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
            $file->user =  \Auth::user()->name;
        $file->status=1;
        $file->save();
        return back()->with(['status' => 'Status is active successfully.']);
        
    }
     public function wninnotice($id)
    {
        $file=Post::find($id);
         $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"notice",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
            $file->user = \Auth::user()->name;
        $file->notice=2;
        $file->save();
        return back()->with(['status' => ' Notice is inactive successfully.']);
        
    }
    
     public function wnacnotice($id)
    {
        $file=Post::find($id);
         $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"notice",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
            $file->user = \Auth::user()->name;
        $file->notice=1;
        $file->save();
        return back()->with(['status' => 'Notice is active successfully.']);
        
    }
     public function whinnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"highlight",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
            $file->user = \Auth::user()->name;
        $file->highlight=2;
        $file->save();
        return back()->with(['status' => ' Highlight is inactive successfully.']);
        
    }
    
     public function whacnotice($id)
    {
        $file=Post::find($id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$file->id,
            'type'=>"highlight",
            'Pub_Date'=>$file->Pub_Date,
            'Category'=>$file->Category,
            'Heading'=>$file->Heading,
            'Sub_Heading'=>$file->Sub_Heading,
            'Start_Date'=>$file->Start_Date,
            'End_Date'=>$file->End_Date,
            'Details'=>$file->Details,
            'Cover_Photo'=>$file->Cover_Photo,
            
            'status'=>$file->status,
            'Document_Link'=>$file->Document_Link,
            'gimage'=>$file->gimage,
            'notice'=>$file->notice,
            'highlight'=>$file->highlight,
            'user'=>$file->user,
            ]);
            $file->user = \Auth::user()->name;
        $file->highlight=1;
        $file->save();
        return back()->with(['status' => 'Highlight is active successfully.']);
        
    }
    public function wpublish(Request $request)
    {
        $file=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
        $file->Pub_Date=$request->Pub_date;
        $file->Start_Date=$request->Pub_date;
        $file->save();
        return back()->with(['status' => 'Post is publish successfully.']);
        
    }
    public function wremove(Request $request)
    {
    //   dd($request);
        if($request->file=='cimage'){
        $remove=Post::find($request->id);
       $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
        $files= $remove->Cover_Photo;
        // dd($files);
        $filename = 'uploads/post/'.$files;
        \File::delete($filename);
            $remove->Cover_Photo="";
            $remove->save();
        }
        if($request->file=='Dimage'){
        $remove=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
        $files= $remove->Document_Link;
        // dd($files);
        $filename = 'uploads/post/'.$files;
        \File::delete($filename);
            $remove->Document_Link="";
            $remove->save();
        }
        if($request->file=='gimage'){
        $remove=Post::find($request->id);
        $back_post=\DB::table('back_posts')->insert([
            'post_id'=>$remove->id,
            'type'=>"remove",
            'Pub_Date'=>$remove->Pub_Date,
            'Category'=>$remove->Category,
            'Heading'=>$remove->Heading,
            'Sub_Heading'=>$remove->Sub_Heading,
            'Start_Date'=>$remove->Start_Date,
            'End_Date'=>$remove->End_Date,
            'Details'=>$remove->Details,
            'Cover_Photo'=>$remove->Cover_Photo,
            
            'status'=>$remove->status,
            'Document_Link'=>$remove->Document_Link,
            'gimage'=>$remove->gimage,
            'notice'=>$remove->notice,
            'highlight'=>$remove->highlight,
            'user'=>$remove->user,
            ]);
            $remove->user = \Auth::user()->name;
            $remove->gimage="";
            $remove->save();
        }
        
        return back()->with(['status' => ' File Remove successfully.']);
        
    }
}
