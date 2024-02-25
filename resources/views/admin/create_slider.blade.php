@extends('layouts.admin')
@section('contant')
<div class="" >
<!-- @if(Session::has('status'))
    <div class="alert alert-success">
        {{Session::get('status')}}
    </div>
@endif -->
<!-- @if (session('status'))
 <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
    </div>
                            @endif -->
<p class="h5">Slider Create</p>

<form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">

     <label>Image</label>
     <input type="file" name="image" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>Title</label>
     <input type="text" name="title" class="form-control" value="" />
    </div>
    <div class="form-group">
     <label>Description</label>
     <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
     <input type="submit" name="send" class="btn btn-info" value="Send" />
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

