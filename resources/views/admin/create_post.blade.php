@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Posts</p>

<form action="{{url('admin/post/store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option value="{{$cat->name}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Heading</label>
     <input type="text" name="Heading" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Sub_Heading</label>
     <textarea name="Sub_Heading" id="txtEditorh" class="form-control textarea2" require></textarea>
    </div>
    <div class="form-group">
     <label>Start Date</label>
     <input type="date" name="Start_Date" class="form-control" value=""  require/>
    </div>
    <div class="form-group">
     <label>End Date</label>
     <input type="date" name="End_Date" class="form-control" value="" require />
    </div>
    <div class="form-group">
     <label>Details</label>
     <textarea name="Details" class="form-control textarea" id="txtEditor"></textarea>
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="Cover_Photo" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>Document Link</label>
     <input type="file" name="Document_Link" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>Image ( Multiple Image )</label>
     <input type="file" name="gimage[]" class="form-control" value="" multiple/>
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

