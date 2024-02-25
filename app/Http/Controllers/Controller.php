<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Event;
use App\Models\Massege;
use App\Models\Success;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\Gcategory;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Qlink;
use App\Models\Member;
use App\Models\Contact;
use App\Models\Former;
use App\Models\Docment;
use App\Models\Category;
use App\Models\Leadership;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function slider(){
        $slider= Slider::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('slider')
       ]);
    }

    public function event(){
        $event= Event::OrderBy('id','DESC')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('event')
       ]);
    }
     public function get_event($event_id){
        $event= Event::where('id',$event_id)->first();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('event')
       ]);
    }
 public function document(){
        $document= Docment::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('document')
       ]);
    }
    public function notice(){
        $notice= Post::OrderBy('Pub_Date','DESC')->select('id','Heading','End_Date')->where('status',1)->where('notice',1)->where("Pub_Date","<=",date('Y-m-d'))->where("Start_Date","<=",date('Y-m-d'))->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('notice')
       ]);
    }
// notice page api
    public function noticepage(){
        $noticenews= Post::OrderBy('Pub_Date','DESC')->whereIn('Category', ['Notice', 'Press Release','Announcement','Statement'])->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('noticenews')
       ]);
    }
// News api
    public function update_news(){
        $newsupdate= Post::OrderBy('Pub_Date','DESC')->select('id','Heading')->where('Category','News')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('newsupdate')
       ]);
    }
    public function news_morning(){
        $news_morning= Post::OrderBy('Pub_Date','DESC')->where("Pub_Date","<=",date('Y-m-d'))->where('Category','শোক সংবাদ (Mourning News)')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('news_morning')
       ]);
    }
     public function news_activity_Update(){
        $news_activity_Update= Post::OrderBy('Pub_Date','DESC')->where("Pub_Date","<=",date('Y-m-d'))->where('Category','Activity Update')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('news_activity_Update')
       ]);
    }
     public function news_congratulation_on_achievenemnt(){
        $news_congratulation_on_achievenemnt= Post::OrderBy('Pub_Date','DESC')->where("Pub_Date","<=",date('Y-m-d'))->where('Category','Congratulation on Achievenemnt')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('news_congratulation_on_achievenemnt')
       ]);
    }
    public function news(){
        $news= Post::OrderBy('Pub_Date','DESC')->where("Pub_Date","<=",date('Y-m-d'))->where('Category','News')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('news')
       ]);
    }
    public function highlight(){
        $highlight= Post::OrderBy('Pub_Date','DESC')->where('status',1)->where('highlight',1)->where("Pub_Date","<=",date('Y-m-d'))->where("Start_Date","<=",date('Y-m-d'))->get()->take(5);
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('highlight')
       ]);
    }

    public function massege(){
        $massege= Massege::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('massege')
       ]);
    }
     public function leadership(){
        $leadership= Leadership::OrderBy('session','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('leadership')
       ]);
    }
    public function success(){
        $success= Success::OrderBy('order_by','ASC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('success')
       ]);
    }
    public function gallery(){
        $gallery= Gallery::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('gallery')
       ]);
    }

    public function service(){
        $service= Service::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('service')
       ]);
    }

    public function blog($mid){
        $blog= Blog::OrderBy('id','DESC')->where('user_id',$mid)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('blog')
       ]);
    }
    //Approved
     public function Approvedblog(){
        $blog= Blog::OrderBy('id','DESC')->where('status','Approved')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('blog')
       ]);
    }
    public function blogs(){
        $blog= Blog::OrderBy('id','DESC')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('blog')
       ]);
    }
     public function blog_status(Request $request){
        $blog= Blog::where('id',$request->blog_id)->first();
        $blog->status=$request->status;
        $blog->approveDate =$request->approveDate;
        $blog->massege=$request->massege;
        $blog->save();
        
    $res = [
         'message' => 'Blog Status Update  Successfully',
       
     ];
     return response($res, 200);
    }
    // admin
    public function adminlist($admin){
        $admin= Member::where('MemberRole', $admin)->get();
        
         return response()->json(["status" => "success", "code" => 200
        , "data" => compact('admin')
       ]);
    }
     public function admin_status(Request $request){
       
         $blog = Member::where('BPID', $request->pmsid)->first();
        
        if($blog){
        $blog->MemberRole=$request->role;
        $blog->save();
        $res = [
         'message' => 'Admin  Status Update  Successfully',
       
     ];
        }
        
     return response($res, 200);
    }
    public function user_role(Request $request){
        $count=Member::where('MemberRole','admin')->count();
        // return response($count, 200);
         $blog = Member::where('BPID', $request->pmsid)->first();
         if($count >= 3){
              $res = [
         'message' => 'Member Admin is not possible !',
       
     ];
         }else{
        //$blog= ::where('UniqueID',$request->pmsid)->first();
        $blog->MemberRole=$request->role;
        $blog->save();
        
    $res = [
         'message' => 'Member  Status Update  Successfully',
       
     ];
         }
     return response($res, 200);
    }
    
    public function blog_update(Request $request){
        $blog= Blog::where('id',$request->blog_id)->first();
        
        $blog->title=$request->title;
        $blog->summery=$request->summery;
        $blog->description=$request->description;
        $blog->vedio_link=$request->vedio_link;
        $blog->user_id=$request->member_id;
        $blog->memberName=$request->memberName;
        $blog->image=$request->image;
        $blog->save();
        
    $res = [
         'message' => 'Blog Update  Successfully',
       
     ];
     return response($res, 200);
    }
    public function blog_create(Request $request){
      $data = $request->validate([
         'title' => 'required|string',
         'member_id' => 'required',
         'description' => 'required|string|unique:users,email',
         
     ]);

     $user = Blog::create([
         'title' => $data['title'],
         'summery' => $request->summery,
         'description' => $data['description'],
         'image' => $request->image,
         'vedio_link' => $request->vedio_link,
         'status' => $request->status,
         'user_id' => $request->member_id,
         'memberName' => $request->memberName
     ]);

     //$token = $user->createToken('apiToken')->plainTextToken;

     $res = [
         'message' => 'Blog Create Successfully',
       
     ];
     return response($res, 200);
    }
    public function local(){
        $local= Qlink::OrderBy('order','ASC')->where('status',1)->where('type','Local')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('local')
       ]);
    }
    public function international(){
        $international= Qlink::OrderBy('order','ASC')->where('type','International')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('international')
       ]);
    }
    
    public function gcategory(){
        $Gallerycategory= Gcategory::OrderBy('id','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('Gallerycategory')
       ]);
    }
    
    public function get_gallery($id){
        $Gallery= Gallery::where('gcat_id',$id)->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('Gallery')
       ]);
    }
    public function get_massege($id){
        $massegedetials= Massege::where('id',$id)->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('massegedetials')
       ]);
    }
    public function get_news($id){
        $news=Post::where('id',$id)->where('status',1)->first();
        $category=Category::select('id','name')->get();
        $sameNews=Post::OrderBy('Pub_Date','DESC')->where('Category',$news->Category)->where('id','!=',$news->id)->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('news','category','sameNews')
       ]);
    }
     public function video(){
        $video= Video::where('status',1)->select('video','ylink')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('video')
       ]);
    }
    public function get_video($id){
        $video= Video::where('gcat_id',$id)->where('status',1)->select('video','ylink')->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('video')
       ]);
    }
    public function get_home_page_gallery(){
       $gallery= Gallery::OrderBy('id','DESC')->where('home_page',1)->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('gallery')
       ]);
    }
    public function former(){
        $former= Former::OrderBy('Session','DESC')->where('status',1)->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('former')
       ]);
    }
    
    
    public function contact(Request $request){
        $slider= new Contact();
        $slider->name = $request->input('name');
        $slider->subject = $request->input('subject');
        $slider->phone = $request->input('phone');
        $slider->email = $request->input('email');
        $slider->massege = $request->input('massege');
        $slider->save();
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->massege;

        $msg = '
<html>
<head>
  <title>Mail from ' . $name . '</title>
</head>
<body>
  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Name:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $name . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Phone:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $phone . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $email . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Subject:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $subject . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Message:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $message . '</td>
   </tr>
  </table>
</body>
</html>
';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";

        if(mail('info@techsimpleict.com',$subject,$msg,$headers)){
            return response()->json(["status" => "success", "code" => 200,"massege"=>"Massege has been send !!",]);
        }else{
            
            return response()->json(["status" => "success", "code" => 200,"massege"=>"Something went wrong! Please try again",]);
        }
        return redirect()->back();
        
        
        

    } public function committee(){
       $committees = \DB::table('committees')
            ->join('designations', 'committees.BPSA_Designation_id', '=', 'designations.id')
            ->join('comm_groups', 'committees.comm_group_slug', '=', 'comm_groups.slug')
            ->select('committees.*', 'designations.name as designation','comm_groups.name as commGroup')
            ->OrderBy('committees.Association_Year','DESC')
            ->OrderBy('committees.serial_no','ASC')
            ->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('committees')
       ]);
    }
    public function committee_session($session){
       $committees = \DB::table('committees')
            ->join('designations', 'committees.BPSA_Designation_id', '=', 'designations.id')
            ->join('comm_groups', 'committees.comm_group_slug', '=', 'comm_groups.slug')
            ->select('committees.*', 'designations.name as designation','comm_groups.name as commGroup')
            ->where("Association_Year",$session)
            ->OrderBy('committees.serial_no','ASC')
            ->get();
        return response()->json(["status" => "success", "code" => 200
        , "data" => compact('committees')
       ]);
    }
    

}
