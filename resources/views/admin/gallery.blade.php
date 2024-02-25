@extends('layouts.admin')
@section('contant')
<p class=" text-center text-info h4 "><i>Gallery Lists</i></p>
<a class="btn btn-primary btn-sm" href="{{url('admin/gallery/create')}}"> 
     New Gallery</a> 

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>


<th>ID</th>
    
<th>Category</th>
<th>Title</th>
<th>Description</th>

<th>Image</th>
<th>Home Page</th>
<th>User </th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($images as $order)


<tr>
     <td>{{@$order->id }}</td>

    <td><?php $gcat=App\Models\Gcategory::where('id',@$order->gcat_id)->first();?>{{@$gcat->name }}</td>
    

    <td>{{@$order->title }}</td>
    <td>{!!@$order->description !!}</td>
   
    <td><img src="{{@$order->image}}" style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;" alt="Responsive image"></td>
    <td> 
    @if(@$order->home_page==1)
    <a class="btn btn-primary btn-sm" href="{{url('admin/gallery/innotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('admin/gallery/acnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 
<td>{!!@$order->user !!}</td>
<td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" ><i class="fa fa-edit"></i></a>
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Gallery Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  <form action="{{url('admin/gallery/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->id==$order->gcat_id) echo"selected";?> value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>title</label>
     <input type="text" name="title" class="form-control" value="{{$order->title}}" require/>
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" id="txtEditorh" class="form-control textarea2" >{!!$order->description!!}</textarea>
    </div>
    
    
    <div class="form-group">
     <label>Image </label>
     <input type="file" name="image" class="form-control" value="" />
     <span><img src="{{@$order->image}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <
        
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
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gallery?');" href="{{url('admin/gallery/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        
       

</td>
 
</tr>

@endforeach
</tbody>
</table>
{{--{{$images->links('pagination::bootstrap-4')}}--}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>







@endsection