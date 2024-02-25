<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gcategory;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller{
    
    public function index(){
        $users=User::all();
        return view('admin.user')->with('users',$users);
    }
    
    public function create()
    {
     
        return view('admin.create_user');
    }
    
      public function store(Request $request)
    {
        $user= new User();
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('userType');
        
        if($request->input('password')){
           $user->password = Hash::make($request->input('password'));
        }

	 $user->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'User make successfully.']);
    }
    
     public function update(Request $request)
    {
        
        $user= User::where('id',$request->input('id'))->first();
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('userType');
        
        if($request->input('password')){
           $user->password = Hash::make($request->input('password'));
        }

	 $user->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'User Update successfully.']);
   
    }
    
    public function destroy($id)
    {
        $file=User::find($id);
     
     
        if(User::destroy($id)){
       
            return back()->with(['status' => 'User Delete successfully.']);
        }
        else{
            return back()->with(['status' => 'Someting is wrong.']);
        }
    }
 
}