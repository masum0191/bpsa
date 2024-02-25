@extends('layouts.admin');
@section('contant')
<p class=" text-center text-info h4 "><i>Events </i></p>
<a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#event">New Event</a> 
<div class="modal fade bd-example-modal-lg" id="event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  <form action="{{url('admin/event/store/')}}" method="post" enctype="multipart/form-data">
@csrf

    <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" id="txtEditorh" class="form-control " ></textarea>
    </div>
    
    
    <div class="form-group">
     <label>Image </label>
     <input type="file" name="image" class="form-control" value="" />
    
    </div>
     <div class="form-group">
     <label>Start Date</label>
     <input type="date" name="start_date" class="form-control" value="" require/>
    </div>
      <div class="form-group">
     <label>End Date</label>
     <input type="date" name="date" class="form-control" value="" require/>
    </div>
     <div class="form-group">
     <label>Time</label>
     <input type="time" name="time" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Venue</label>
     <input type="text" name="events" class="form-control" value="" require/>
    </div>
    <div class="form-group">
     <label>Vedio Link</label>
     <input type="text" name="vlink" class="form-control" value="" />
    </div>
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Submit" />
    </div>
    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
<th>ID</th>
<th>Title</th>
<th>Image</th>
<th>Venue</th>
<th>Start Date</th>
<th>End Date</th>
<th>Time</th>
<th>Link</th>
<th>Description</th>
<th>User</th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($images as $order)


<tr>     <td>{{@$order->id }}</td>
     <td>{{@$order->title }}</td>
<td><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></td>
   
    <td>{{@$order->events }}</td>
     <td>{{@$order->start_date }}</td>
    <td>{{@$order->date }}</td>
    <td>{{@$order->time }}</td>
    <td>{!!@$order->vedio_link !!}</td>
    <td>{{@$order->description }}</td>
    <td>{{@$order->user }}</td>
    

<td>

        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#edit{{@$order->id}}"><i class="fa fa-edit"></i></a>
        
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Events Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  <form action="{{url('admin/event/update/')}}" method="post" enctype="multipart/form-data">
@csrf
 <input type="hidden" name="id" class="form-control" value="{{$order->id}}" require/>
    <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="{{$order->title}}" require/>
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" id="txtEditorh" class="form-control " >{!! $order->description !!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Image </label>
     <input type="file" name="image" class="form-control" value="" />
     <span><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
     <div class="form-group">
     <label>Start Date</label>
     <input type="date" name="start_date" class="form-control" value="{{@$order->start_date}}" require/>
    </div>
    <div class="form-group">
     <label>End Date</label>
     <input type="date" name="date" class="form-control" value="{{@$order->date}}" require/>
    </div>
    <div class="form-group">
     <label>Time</label>
     <input type="time" name="time" class="form-control" value="{{@$order->time}}" require/>
    </div>
    <div class="form-group">
     <label>Venue</label>
     <input type="text" name="events" class="form-control" value="{{$order->events}}" require/>
    </div>
    <div class="form-group">
     <label>Vedio Link</label>
     <input type="text" name="vlink" class="form-control" value="{{$order->vedio_link}}" />
    </div>
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Submit" />
    </div>
    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Event?');" href="{{url('admin/event/destroy/'.$order->id)}}"><i class="fa fa-trash"></i></a>
       

</td>
 
</tr>

@endforeach
</tbody>
</table>

@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>





<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
if ("{{ session('status') }}") {
    swal("{{ session('status') }}");
    
}
    

</script>


@endsection