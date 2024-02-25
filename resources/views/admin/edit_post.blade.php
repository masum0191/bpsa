@extends('layouts.admin')
@section('contant')
<div class="" >

<p class="h5">Posts Update</p>

<form action="{{url('admin/post/update/')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<input type="hidden" name="id" class="form-control" value="{{$post->id}}" />
     <label>Category</label>
     
     <select name="Category" id="" class="form-control">
     @foreach($category as $cat)
        <option <?php if($cat->name==$post->Category) echo"selected";?> value="{{$cat->name}}">{{$cat->name}} </option>
        @endforeach
     </select>
    </div>
    <div class="form-group">
     <label>Heading</label>
     <input type="text" name="Heading" class="form-control" value="{{$post->Heading}}" require/>
    </div>
    <div class="form-group">
     <label>Sub_Heading</label>
     <textarea name="Sub_Heading" id="txtEditorh" class="form-control textarea2" require>{!!$post->Sub_Heading!!}</textarea>
    </div>
    <div class="form-group">
     <label>Start Date</label>
     <input type="date" name="Start_Date" class="form-control" value="{{$post->Start_Date}}"  require/>
    </div>
    <div class="form-group">
     <label>End Date</label>
     <input type="date" name="End_Date" class="form-control" value="{{$post->End_Date}}" require />
    </div>
    <div class="form-group nopadding">
     <label>Details</label>
     <textarea name="Details" class="form-control textarea" id="txtEditor">{!!$post->Details!!}</textarea>
    </div>
    <div class="form-group">
     <label>Cover Photo</label>
     <input type="file" name="Cover_Photo" class="form-control" value="" />
     <span><img src="{{@$post->Cover_Photo}}" style="height: 100px; width:100px;" alt="Responsive image"></span>
    </div>
    <div class="form-group">
     <label>Document Link</label>
     <input type="file" name="Document_Link" class="form-control" value="" />
     <span> <a class="" href="{{@$post->Document_Link}}">{{@$post->Document_Link}}</a></span>
    </div>
    <div class="form-group">
     <label>Image ( Multiple Image )</label>
     <input type="file" name="gimage[]" class="form-control" value="" multiple/>
     <div class="modal-body">
            @if($post->gimage)
            <ul class="nav nav-tabs" role="tablist">
          
            <?php $gellary= json_decode($post->gimage);?>
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

