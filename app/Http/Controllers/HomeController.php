<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Blog;
   
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('admindashboard');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $post=Post::orderBy('id','DESC')->get()->take(5);
        $blog=Blog::orderBy('id','DESC')->get()->take(5);
        //dd($post);
        return view('admindashboard')->with('post',$post)->with('blog',$blog);
    }
    
    public function writerHome()
    {
        return view('writerdashboard');
    }
    public function editorHome()
    {
        return view('editordashboard');
    }
}
