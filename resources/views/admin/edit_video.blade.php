@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Video Update</p>

<form action="{{url('admin/video/update')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">

     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->id==$video->gcat_id) echo"selected";?> value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
<div class="form-group">
    <input type="hidden" name="id" class="form-control" value="{{$video->id}}" />

     <label>Upload Video</label>
     <input type="file" name="video" class="form-control" value="" />
     <span class=""> <video width="320" height="240" controls>
  <source src="{{@$video->video}}" type="video/mp4">
  <source src="{{@$video->video}}" type="video/ogg">
  
</video> </span>
    </div>
    <div class="form-group">
     <label>Youtube Link</label>
     <input type="text" name="ylink" class="form-control" value="" />
     <span>{!!@$video->ylink!!}</span>
    </div>
    
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Update" />
    </div>
    </form>
<!-- </form> -->

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
@section('footer2')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if (session('status')) {
    swal("{{ session('status') }}");
    
}
   

</script>


@endsection
