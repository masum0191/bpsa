@extends('layouts.writer')
@section('contant')
<div class="" >

<p class="h5">Committee Create</p>

<form action="{{url('writer/committee/store')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
     <label>Serial No</label>
     <input type="Number" name="serial_no" class="form-control" value="" require/>
    </div>
    <div class="form-group">
    
     <label>Comm Group</label>
     
     <select name="comm_group_slug" id="" class="form-control">
     <option >Select One</option>
     @foreach($comm_group as $d)
        <option value="{{$d->slug}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>PIMS ID</label>
     <input type="Number" name="PIMS_ID" class="form-control" value="" require/>
    </div>
    <div class="form-group">
    
     <label>BPSA Designation</label>
     
     <select name="BPSA_Designation_id" id="" class="form-control">
     <option >Select One</option>
     @foreach($desination as $d)
        <option value="{{$d->id}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Name</label>
     <input type="text" name="Name" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Photo</label>
     <input type="file" name="photo" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Officail Designation</label>
     <input type="text" name="Officail_Designation" class="form-control" value=""  require/>
    </div>
    <div class="form-group">
     <label>Mobile Number</label>
     <input type="text" name="Mobile_Number" class="form-control" value="" require />
    </div>
    <div class="form-group">
     <label>Association Year</label>
     <input type="text" name="Association_Year" class="form-control" value="" require />
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

    <div class="pull-right">
        {{-- <a class="btn btn-primary" href="{{ route('itemCRUD.index') }}"> Back</a> --}}
    </div>


@endsection

