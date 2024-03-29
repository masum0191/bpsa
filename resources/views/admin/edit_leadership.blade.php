@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Leadership Update</p>

<form action="{{url('admin/leadership/update/')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
     <label>Session</label>
     <input type="text" name="session" class="form-control" value="{{$massege->session}}" />
    </div>
    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{$massege->id}}" />
     <label>Name</label>
     <input type="text" name="name" class="form-control" value="{{$massege->name}}" require/>
    </div>
     <div class="form-group">
     <label>BPSA Designation</label>
     <input type="text" name="BPSA_Designation" class="form-control" value="{{$massege->BPSA_Designation}}" />
    </div>
    <div class="form-group">
     <label>Official designation</label>
     <input type="text" name="Official_designation" class="form-control" value="{{$massege->Official_designation}}" />
    </div>
    <div class="form-group">
     <label>Note</label>
     <textarea name="note" id="txtEditorh" class="form-control textarea2" >{!!$massege->note!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Photo </label>
     <input type="file" name="photo" class="form-control" value="" />
     <span><img src="{{@$massege->photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
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

