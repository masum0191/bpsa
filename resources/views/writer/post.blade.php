@extends('layouts.writer')
@section('contant')

<div class="row">
    <div class="col-md-6">
        <h3>POST LISTS</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('writer/post/create')}}">  New Post</a> 
    </div>
</div>

    

<table class="table table-hover table-bordered" id="sampleTableg">
    <thead>



    
<th>Category</th>
<th>Heading</th>
<th>Sub <br> Heading</th>
<th>Publish <br> Date</th>

<th>Details</th>
<th>Cover <br>  Photo</th>
<th>Document <br> Link</th>
<th>Status</th>
<th>Notice</th>
<th>Highlights</th>
<th>Action</th>
</thead>
   
   
@foreach ($images as $order)


<tr>

    <td>
    {!!@$order->Category !!}</td>
    

    <td>{{@$order->Heading }}</td>
    <td>{!!@$order->Sub_Heading !!}</td>
    <td>
        @if(@$order->Pub_Date==null)
   <a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#Publish{{@$order->id}}">Publish</a>
   <div class="modal fade" id="Publish{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Publish Date </h5>
                
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          <form action="{{url('writer/post/publish/')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label>Publish Date</label>
            <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
            <input type="date" name="Pub_date" class="form-control" value=""  />
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
    @else
    <a class="btn btn-primary  btn-sm" ">{{@$order->Pub_Date }}</a>
    @endif
        </td>
   
   
    <td>{!!@$order->Details !!}</td>
    <td><img src="{{@$order->Cover_Photo}}" style="height: 100px; width:100px;border-radius: 5%; background:#ccc;padding:5px;" alt="Responsive image"></td>
    <td><a class="" target="_blank" href="{{@$order->Document_Link}}">{{Str::limit($order->Document_Link, 15)}}</a></td>
 <td> 
    @if(@$order->status==1)
    <a class="btn btn-primary btn-sm" href="{{url('writer/post/sinnotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('writer/post/sacnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 
     <td> 
    @if(@$order->notice==1)
    <a class="btn btn-primary btn-sm" href="{{url('writer/post/ninnotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('writer/post/nacnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 
     <td> 
    @if(@$order->highlight==1)
    <a class="btn btn-primary btn-sm" href="{{url('writer/post/hinnotice/'.@$order->id)}}"><i class="fa fa-solid fa-toggle-on"></i></a>
    @else
    <a class="btn btn-dark  btn-sm"  href="{{url('writer/post/hacnotice/'.@$order->id)}}"><i class="fa fa-thin fa-toggle-off"></i></a>
    @endif
    </td> 
<td>

        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit{{@$order->id}}" href="#"><i class="fa fa-edit"></i></a>
         <!--edit start Modal -->
        <div class="modal fade" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Posts Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        <form action="{{url('writer/post/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->name==$order->Category) echo"selected";?> value="{{$cat->name}}">{{$cat->name}} </option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Heading</label>
     <input type="text" name="Heading" class="form-control" value="{{$order->Heading}}" require/>
    </div>
    <div class="form-group">
     <label>Sub_Heading</label>
     <textarea name="Sub_Heading" id="txtEditorh" class="form-control textarea2" require>{!!$order->Sub_Heading!!}</textarea>
    </div>
    <div class="form-group">
     <label>Start Date</label>
     <input type="date" name="Start_Date" class="form-control" value="{{$order->Start_Date}}"  require/>
    </div>
    <div class="form-group">
     <label>End Date</label>
     <input type="date" name="End_Date" class="form-control" value="{{$order->End_Date}}" require />
    </div>
    <div class="form-group nopadding">
     <label>Details</label>
     <textarea name="Details" class="form-control textarea" id="txtEditor">{!!$order->Details!!}</textarea>
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="Cover_Photo" class="form-control" value="" />
     <span><img src="{{@$order->Cover_Photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <div class="form-group">
     <label>Document Link</label>
     <input type="file" name="Document_Link" class="form-control" value="" />
     <span> <a class="" href="{{@$order->Document_Link}}">{{@$post->Document_Link}}</a></span>
    </div>
    <div class="form-group">
     <label>Image ( Multiple Image )</label>
     <input type="file" name="gimage[]" class="form-control" value="" multiple/>
     <div class="modal-body">
            @if($order->gimage)
            <ul class="nav nav-tabs" role="tablist">
          
            <?php $gellary= json_decode($order->gimage);?>
                                    @foreach ($gellary as $g)
                                    <li class="nav-item">
                                        <a class="example-image-link nav-link active" href="{{asset('uploads/post/'.$g)}}"
                                            data-lightbox="example-set"
                                            data-title="Click the right half of the image to move forward."><img
                                                class="example-image" src="{{asset('uploads/post/'.$g)}}" alt=""
                                                style="width:100%; height:110px;" /></a>

                                    </li>
                                    @endforeach


                                </ul>
            @else
            <p>No Gallery</p>
            @endif
            </div>
     <span></span>
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
         <!--edit end Modal -->
        
        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Post?');" href="{{url('writer/post/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        <a class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#exampleModalCenter{{@$order->id}}"><i class="fa fa-image"></i></a>
       <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Gallery Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @if($order->gimage)
            <ul class="nav nav-tabs" role="tablist">
          
            <?php $gellary= json_decode($order->gimage);?>
                                    @foreach ($gellary as $g)
                                    <li class="nav-item">
                                        <a class="example-image-link nav-link active" href="{{asset('uploads/post/'.$g)}}"
                                            data-lightbox="example-set"
                                            data-title="Click the right half of the image to move forward."><img
                                                class="example-image" src="{{asset('uploads/post/'.$g)}}" alt=""
                                                style="width:100%; height:110px;" /></a>

                                    </li>
                                    @endforeach


                                </ul>
            @else
            <p>No Gallery</p>
            @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>
        
        <a class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#reomve{{@$order->id}}"><i class='fa fa-remove'></i>
</a>
       <!-- Modal -->
        <div class="modal fade" id="reomve{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="col-md-8">
                 
           <img src="{{@$order->Cover_Photo}}" style="height: 100px; width:100px;" alt="Responsive image">
            </div>
             <div class="col-md-4">
             <form action="{{url('writer/post/remove/')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
           
            <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
            <input type="hidden" name="file" class="form-control" value="cimage"  />
          </div>
           <div class="form-group">
            <input type="submit" name="send" class="btn btn-danger" value="remove" />
            </div>
            </form>
            </div>
            </div>
            <div class="row">
            <div class="col-md-8">
                
           <a class="" target="_blank" href="{{@$order->Document_Link}}">{{Str::limit($order->Document_Link, 20)}}</a>
            </div>
             <div class="col-md-4">
             <form action="{{url('writer/post/remove/')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
           
            <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
            <input type="hidden" name="file" class="form-control" value="Dimage"  />
          </div>
           <div class="form-group">
            <input type="submit" name="send" class="btn btn-danger" value="remove" />
            </div>
            </form>
            </div>
            </div>
            <div class="row">
            <div class="col-md-8">
            
            @if($order->gimage)
            <ul class="nav nav-tabs" role="tablist">
          
            <?php $gellary= json_decode($order->gimage);?>
                                    @foreach ($gellary as $g)
                                    <li class="nav-item">
                                        <a class="example-image-link nav-link active" href="{{asset('uploads/post/'.$g)}}"
                                            data-lightbox="example-set"
                                            data-title="Click the right half of the image to move forward."><img
                                                class="example-image" src="{{asset('uploads/post/'.$g)}}" alt=""
                                                style="width:50px; height:50px;" /></a>

                                    </li>
                                    @endforeach


                                </ul>
            @else
            <p>No Gallery</p>
            @endif
            </div>
             <div class="col-md-4">
             <form action="{{url('writer/post/remove/')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
           
            <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
            <input type="hidden" name="file" class="form-control" value="gimage"  />
          </div>
           <div class="form-group">
            <input type="submit" name="send" class="btn btn-danger" value="remove" />
            </div>
            </form>
            </div>
            </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>

</td>
 
</tr>

@endforeach


</table>
{{$images->links('pagination::bootstrap-4')}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">

        $("#sampleTable").DataTable();
        
</script>






    

</script>


@endsection