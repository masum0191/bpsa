@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Former Update</p>

<form action="{{url('admin/former/store/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">

     <label>Session</label>
      <input type="text" name="Session" class="form-control" value="" require/>
     
    </div>
    <div class="form-group">
     <label>President Name</label>
     <input type="text" name="President_Name" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>President Designation</label>
     <input type="text" name="President_Designation" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>President Image</label>
     <input type="file" name="President_Image" class="form-control" value="" />
     
    </div>
   
   <div class="form-group">
     <label>Secretary Name</label>
     <input type="text" name="Secretary_Name" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Secretary Designation</label>
     <input type="text" name="Secretary_Designation" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Secretary Image</label>
     <input type="file" name="Secretary_Image" class="form-control" value="" />
     
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
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">

        $("#sampleTable").DataTable();
        
</script>





<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
    

</script>


@endsection
