@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Successe Update</p>

<form action="{{url('admin/successe/update/')}}" method="post" enctype="multipart/form-data">
@csrf

    <div class="form-group">
        <input type="hidden" name="id" class="form-control" value="{{$massege->id}}" />
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="{{$massege->title}}" require/>
    </div>
    <div class="form-group">
     <label>Note</label>
     <textarea name="note" id="txtEditorh" class="form-control " maxlength="500" >{!!$massege->note!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Photo </label>
     <input type="file" name="photo" class="form-control" value="" />
     <span><img src="{{@$massege->image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <
        
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

