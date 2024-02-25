@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Leadership Create</p>

<form action="{{url('admin/leadership/store')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
     <label>Session</label>
     <input type="text" name="session" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Name</label>
     <input type="text" name="name" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>BPSA Designation</label>
     <input type="text" name="BPSA_Designation" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Official designation</label>
     <input type="text" name="Official_designation" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Note</label>
     <textarea name="note" id="txtEditorh" class="form-control textarea" ></textarea>
    </div>
   
    <div class="form-group">
     <label>Photo </label>
     <input type="file" name="photo" class="form-control" value="" />
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

