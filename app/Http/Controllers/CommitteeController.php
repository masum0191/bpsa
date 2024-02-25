<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\Designation;
use App\Models\Comm_group;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $session= \DB::table('associations')->get();
        $comm_group= Comm_group::get();
        $desination= Designation::get();
        $committee= Committee::OrderBy('serial_no','ASC')->get();
        return view('admin.committe')->with('committee',$committee)->with('desination',$desination)->with('comm_group',$comm_group)->with('session',$session);
    }

 public function windex()
    {
         $comm_group= Comm_group::get();
        $desination= Designation::get();
        $committee= Committee::OrderBy('serial_no','ASC')->paginate(10);
        return view('writer.committe')->with('committee',$committee)->with('desination',$desination)->with('comm_group',$comm_group);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $desination= Designation::all();
        $comm_group= Comm_group::all();
        $session= \DB::table('associations')->get();
        return view('admin.create_committe')->with('desination',$desination)->with('comm_group',$comm_group)->with('session',$session);
    }
 public function wcreate()
    {
        $desination= Designation::all();
        $comm_group= Comm_group::all();
        return view('writer.create_committe')->with('desination',$desination)->with('comm_group',$comm_group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $committee= new Committee();
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/committee'), $filename);
            $committee->photo= \URL::to('/uploads/committee/').'/'.$filename;
        }

        $committee->PIMS_ID = $request->input('PIMS_ID');
        $committee->user = 'C-'.\Auth::user()->name;
        $committee->comm_group_slug = $request->input('comm_group_slug');
        $committee->serial_no = $request->input('serial_no');
        $committee->BPSA_Designation_id = $request->input('BPSA_Designation_id');
        $committee->Name = $request->input('Name');
        $committee->medal = $request->input('medal');
        $committee->Officail_Designation = $request->input('Officail_Designation');
        $committee->Mobile_Number = $request->input('Mobile_Number');
        $committee->Association_Year = $request->input('Association_Year');
        $committee->save();
        // Return user back and show a flash message
        return redirect('admin/committee')->with(['status' => 'Committee Create successfully.']);
    }
 public function wstore(Request $request)
    {
       
        $committee= new Committee();
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/committee'), $filename);
            $committee->photo= \URL::to('/uploads/committee/').'/'.$filename;
        }
        $committee->user = 'C-'.\Auth::user()->name;
        $committee->PIMS_ID = $request->input('PIMS_ID');
        $committee->comm_group_slug = $request->input('comm_group_slug');
        $committee->serial_no = $request->input('serial_no');
        $committee->BPSA_Designation_id = $request->input('BPSA_Designation_id');
        $committee->Name = $request->input('Name');
        $committee->medal = $request->input('medal');
        $committee->Officail_Designation = $request->input('Officail_Designation');
        $committee->Mobile_Number = $request->input('Mobile_Number');
        $committee->Association_Year = $request->input('Association_Year');
        $committee->save();
        // Return user back and show a flash message
        return redirect('writer/committee')->with(['status' => 'Committee Create successfully.']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $desination= Designation::all();
        $committee=Committee::where('id',$id)->first();
        $comm_group= Comm_group::all();
        return view('admin.edit_committee')->with('committee',$committee)->with('desination',$desination)->with('comm_group',$comm_group);
    }
 public function wedit( $id)
    {
       
        $desination= Designation::all();
        $committee=Committee::where('id',$id)->first();
        $comm_group= Comm_group::all();
        return view('writer.edit_committe')->with('committee',$committee)->with('desination',$desination)->with('comm_group',$comm_group);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $committee=  Committee::where('id',$request->input('id'))->first();
         
         $back_committee=\DB::table('back_committees')->insert([
            'committee_id'=>$committee->id,
            'type'=>"update",
            'comm_group_slug'=>$committee->comm_group_slug,
            'serial_no'=>$committee->serial_no,
            'PIMS_ID'=>$committee->PIMS_ID,
            'BPSA_Designation_id'=>$committee->BPSA_Designation_id,
            'Name'=>$committee->Name,
            'medal'=>$committee->medal,
            'photo'=>$committee->photo,
            'Officail_Designation'=>$committee->Officail_Designation,
            
            'Mobile_Number'=>$committee->Mobile_Number,
            'Association_Year'=>$committee->Association_Year,
            'AddedBy'=>$committee->AddedBy,
            'PIMS_ID'=>$committee->PIMS_ID,
            'status'=>$committee->status,
            'user'=>$committee->user,
            ]);
        
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/committee'), $filename);
            $committee->photo= \URL::to('/uploads/committee/').'/'.$filename;
        }

        $committee->PIMS_ID = $request->input('PIMS_ID');
         $committee->user =  \Auth::user()->name;
        $committee->comm_group_slug = $request->input('comm_group_slug');
        $committee->serial_no = $request->input('serial_no');
        $committee->BPSA_Designation_id = $request->input('BPSA_Designation_id');
        $committee->Name = $request->input('Name');
        $committee->medal = $request->input('medal');
        $committee->Officail_Designation = $request->input('Officail_Designation');
        $committee->Mobile_Number = $request->input('Mobile_Number');
        $committee->Association_Year = $request->input('Association_Year');
        $committee->save();
        // Return user back and show a flash message
        return back()->with(['status' => 'Committee Update successfully.']);
    }
 public function wupdate(Request $request)
    {
        $committee=  Committee::where('id',$request->input('id'))->first();
          $back_committee=\DB::table('back_committees')->insert([
            'committee_id'=>$committee->id,
            'type'=>"update",
            'comm_group_slug'=>$committee->comm_group_slug,
            'serial_no'=>$committee->serial_no,
            'PIMS_ID'=>$committee->PIMS_ID,
            'BPSA_Designation_id'=>$committee->BPSA_Designation_id,
            'Name'=>$committee->Name,
            'medal'=>$committee->medal,
            'photo'=>$committee->photo,
            'Officail_Designation'=>$committee->Officail_Designation,
            
            'Mobile_Number'=>$committee->Mobile_Number,
            'Association_Year'=>$committee->Association_Year,
            'AddedBy'=>$committee->AddedBy,
            'PIMS_ID'=>$committee->PIMS_ID,
            'status'=>$committee->status,
            'user'=>$committee->user,
            ]);
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/committee'), $filename);
            $committee->photo= \URL::to('/uploads/committee/').'/'.$filename;
        }
        $committee->user =  $committee->user. ','.' U-'.\Auth::user()->name;
        $committee->PIMS_ID = $request->input('PIMS_ID');
        $committee->comm_group_slug = $request->input('comm_group_slug');
        $committee->serial_no = $request->input('serial_no');
        $committee->BPSA_Designation_id = $request->input('BPSA_Designation_id');
        $committee->Name = $request->input('Name');
        $committee->medal = $request->input('medal');
        $committee->Officail_Designation = $request->input('Officail_Designation');
        $committee->Mobile_Number = $request->input('Mobile_Number');
        $committee->Association_Year = $request->input('Association_Year');
        $committee->save();
        // Return user back and show a flash message
        return redirect('writer/committee')->with(['status' => 'Committee Update successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $committee=Committee::find($id);
          $back_committee=\DB::table('back_committees')->insert([
            'committee_id'=>$committee->id,
            'type'=>"delete",
            'comm_group_slug'=>$committee->comm_group_slug,
            'serial_no'=>$committee->serial_no,
            'PIMS_ID'=>$committee->PIMS_ID,
            'BPSA_Designation_id'=>$committee->BPSA_Designation_id,
            'Name'=>$committee->Name,
            'medal'=>$committee->medal,
            'photo'=>$committee->photo,
            'Officail_Designation'=>$committee->Officail_Designation,
            
            'Mobile_Number'=>$committee->Mobile_Number,
            'Association_Year'=>$committee->Association_Year,
            'AddedBy'=>$committee->AddedBy,
            'PIMS_ID'=>$committee->PIMS_ID,
            'status'=>$committee->status,
            'user'=>$committee->user,
            ]);
       $files= $committee->photo;
        // dd($files);
        $filename = 'uploads/committee/'.$files;
        \File::delete($filename);
        if(Committee::destroy($id)){
       
            return redirect('admin/committee')->with(['status' => 'Committee Delete successfully.']);
        }
        else{
            return redirect('admin/committee')->with(['status' => 'Someting is wrong.']);
        }
    }
    public function wdestroy($id)
    {
        $committee=Committee::find($id);
          $back_committee=\DB::table('back_committees')->insert([
            'committee_id'=>$committee->id,
            'type'=>"update",
            'comm_group_slug'=>$committee->comm_group_slug,
            'serial_no'=>$committee->serial_no,
            'PIMS_ID'=>$committee->PIMS_ID,
            'BPSA_Designation_id'=>$committee->BPSA_Designation_id,
            'Name'=>$committee->Name,
            'medal'=>$committee->medal,
            'photo'=>$committee->photo,
            'Officail_Designation'=>$committee->Officail_Designation,
            
            'Mobile_Number'=>$committee->Mobile_Number,
            'Association_Year'=>$committee->Association_Year,
            'AddedBy'=>$committee->AddedBy,
            'PIMS_ID'=>$committee->PIMS_ID,
            'status'=>$committee->status,
            'user'=>$committee->user,
            ]);
       $files= $committee->photo;
        // dd($files);
        $filename = 'uploads/committee/'.$files;
        \File::delete($filename);
        if(Committee::destroy($id)){
       
            return redirect('writer/committee')->with(['status' => 'Committee Delete successfully.']);
        }
        else{
            return redirect('writer/committee')->with(['status' => 'Someting is wrong.']);
        }
    }
}
