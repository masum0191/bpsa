@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Committee Update</p>

<form action="{{url('admin/committee/update')}}" method="post" enctype="multipart/form-data">
@csrf
   <div class="form-group">
     <label>Serial No</label>
     <input type="Number" name="serial_no" class="form-control" value="{{$committee->serial_no}}" />
    </div>
    <div class="form-group">
    
     <label>Comm Group</label>
     
     <select name="comm_group_slug" id="" class="form-control">
     <option >Select One</option>
     @foreach($comm_group as $d)
        <option <?php if($d->slug==$committee->comm_group_slug) echo "selected" ?> value="{{$d->slug}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>PIMS ID</label>
      <input type="hidden" name="id" class="form-control" value="{{$committee->id}}" />
     <input type="Number" name="PIMS_ID" class="form-control" value="{{$committee->PIMS_ID}}" require/>
    </div>
    <div class="form-group">
    
     <label>BPSA Designation</label>
     
     <select name="BPSA_Designation_id" id="" class="form-control">
     <option >Select One</option>
     @foreach($desination as $d)
        <option <?php if($d->id==$committee->BPSA_Designation_id) echo"selected";?> value="{{$d->id}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Name</label>
     <input type="text" name="Name" class="form-control" value="{{$committee->Name}}" require/>
    </div>
    <div class="form-group">
     <label>Photo</label>
     <input type="file" name="photo" class="form-control" value="" require/>
     <span><img src="{{@$committee->photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <div class="form-group">
     <label>Officail Designation</label>
     <input type="text" name="Officail_Designation" class="form-control" value="{{$committee->Officail_Designation}}"  require/>
    </div>
    <div class="form-group">
     <label>Mobile Number</label>
     <input type="text" name="Mobile_Number" class="form-control" value="{{$committee->Mobile_Number}}" require />
    </div>
    <div class="form-group">
     <label>Association Year</label>
      <select name="Association_Year" id="" class="form-control" require>
     <option >Select One</option>
     @foreach($session as $s)
        <option value="{{$s->session}}">{{$s->session}}</option>
        @endforeach
     </select>
    </div>
    
    
   
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Submit" />
    </div>
    </form>
</div>





    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    


@endsection

