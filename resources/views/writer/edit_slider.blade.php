@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Slider Update</p>

<form action="{{url('admin/slider/update')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <input type="hidden" name="id" class="form-control" value="{{$sliders->id}}" />

     <label>Image</label>
     <input type="file" name="image" class="form-control" value="" />
     <span class=""> <img src="{{@$sliders->image}}" alt="" hieght="50px" width="50px"> </span>
    </div>
    <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="{{ $sliders->title }}" />
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" class="form-control" value="">{{ $sliders->description }}</textarea>
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
