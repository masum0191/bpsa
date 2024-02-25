@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Document Create</p>

<form action="{{url('admin/docment/store')}}" method="post" enctype="multipart/form-data">
@csrf
   <div class="form-group">
     <label>Title</label>
     
     <input type="text" name="title" class="form-control" value="" />
    </div>
    <div class="form-group">
    
     <label>Summary</label>
     
     <input type="text" name="summary" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>File</label>
     <input type="file" name="file" class="form-control" value="" />
    
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="c_photo" class="form-control" value="" />
     
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
@section('footer2')







<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
    

</script>


@endsection
