@extends('layouts.admin')
@section('contant')

<div class="row">
    <div class="col-md-6">
        <h3>COMMITTEE LISTS</h3>
    </div>
    <div class="col-md-6 text-right">
    <a class="btn btn-primary btn-sm" href="{{url('admin/committee/create')}}"> New Member</a> 
    </div>
</div>

    

<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
<th>ID</th> 
<th>Serial No</th> 
<th>Comm Group</th> 
<th>PIMS ID</th>   
<th>BPSA <br> Designation</th>
<th>Name</th>
<th>Medal</th>
<th>Photo</th>
<th>Officail<br> Designation</th>
<th>Mobile Number</th>
<th>Association Year</th>
<th>User </th>
<th>Action</th>
</thead>
   
    <tbody>
@foreach ($committee as $order)


<tr>
     <td>{{@$order->id }}</td>
    <td>{{@$order->serial_no }}</td>
    <td>{{@$order->comm_group_slug }}</td>
    <td>{{@$order->PIMS_ID }}</td>
    <td><?php $designation=App\Models\Designation::where('id',@$order->BPSA_Designation_id)->first(); ?>
    {!!@$designation->name !!}</td>
    

    <td>{{@$order->Name }}</td>
    <td>{{@$order->medal }}</td>
    <td><img src="{{@$order->photo }}" style="height: 100px; width:100px; border-radius: 5px;background: #ccc;padding:5px;"> </td>
    <td>{{@$order->Officail_Designation }}</td>
   
    <td>{!!@$order->Mobile_Number !!}</td>
    <td>{!!@$order->Association_Year !!}</td>
    <td>{!!@$order->user !!}</td>
    <td>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{@$order->id}}" href="#"><i class="fa fa-edit"></i></a>
        
         <!--edit start Modal -->
        <div class="modal fade bd-example-modal-lg" id="edit{{@$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Committee Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
       <form action="{{url('admin/committee/update')}}" method="post" enctype="multipart/form-data">
@csrf
   <div class="form-group">
     <label>Serial No</label>
     <input type="Number" name="serial_no" class="form-control" value="{{$order->serial_no}}" />
    </div>
    <div class="form-group">
    
     <label>Comm Group</label>
     
     <select name="comm_group_slug" id="" class="form-control">
     <option >Select One</option>
     @foreach($comm_group as $d)
        <option <?php if($d->slug==$order->comm_group_slug) echo "selected" ?> value="{{$d->slug}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>PIMS ID</label>
      <input type="hidden" name="id" class="form-control" value="{{$order->id}}" />
     <input type="Number" name="PIMS_ID" class="form-control" value="{{$order->PIMS_ID}}" require/>
    </div>
    <div class="form-group">
    
     <label>BPSA Designation</label>
     
     <select name="BPSA_Designation_id" id="" class="form-control">
     <option >Select One</option>
     @foreach($desination as $d)
        <option <?php if($d->id==$order->BPSA_Designation_id) echo"selected";?> value="{{$d->id}}">{{$d->name}}</option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Name</label>
     <input type="text" name="Name" class="form-control" value="{{$order->Name}}" require/>
    </div>
    <div class="form-group">
     <label>Medal</label>
     <input type="text" name="medal" class="form-control" value="{{$order->medal}}" require/>
    </div>
    <div class="form-group">
     <label>Photo</label>
     <input type="file" name="photo" class="form-control" value="" require/>
     <span><img src="{{@$order->photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <div class="form-group">
     <label>Officail Designation</label>
     <input type="text" name="Officail_Designation" class="form-control" value="{{$order->Officail_Designation}}"  require/>
    </div>
    <div class="form-group">
     <label>Mobile Number</label>
     <input type="text" name="Mobile_Number" class="form-control" value="{{$order->Mobile_Number}}" require />
    </div>
    <div class="form-group">
     <label>Association Year</label>
     
      <select name="Association_Year" id="" class="form-control" require>
     <option >Select One</option>
     @foreach($session as $s)
        <option <?php if($order->Association_Year==$s->session)  echo"selected";?> value="{{$s->session}}">{{$s->session}}</option>
        @endforeach
     </select>
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
        
        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this committee?');" href="{{url('admin/committee/destroy/'.@$order->id)}}"><i class="fa fa-trash"></i></a>
        
       

</td>
    

 
</tr>

@endforeach
</tbody>
</table>
{{--{{$committee->links('pagination::bootstrap-4')}}--}}
@endsection
@section('footer2')
<script type="text/javascript" src="{{asset('assets/login/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/login/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<!-- Editor -->
    <link href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<!-- Buttons -->
    <link href="https://nightly.datatables.net/buttons/css/buttons.dataTables.css?_=c6b24f8a56e04fcee6105a02f4027462.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/buttons/js/dataTables.buttons.js?_=c6b24f8a56e04fcee6105a02f4027462"></script>











    

</script>


@endsection