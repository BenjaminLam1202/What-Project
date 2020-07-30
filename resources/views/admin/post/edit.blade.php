@extends('layouts.app')
@section('content')
<div class="container">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <form action="/admin/po/{{$post ->id}}" method="post">
    @csrf


    <div class="">
     {{ __('admin.post') }}: {{$post->title}}
   </div>
   <div class="container">

    <div class="md-form mb-4">
      <i class="fas fa-envelope prefix grey-text"></i>
      <input id="title" type="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title')  ?? $post->title ?? ' '   }}" required>
      <label data-error="wrong" data-success="right" for="defaultForm-email">{{ __('admin.title') }}</label>
    </div>


    <div class="md-form mb-4">
      <i class="fas fa-envelope prefix grey-text"></i>
      <input id="des" type="des" class="form-control{{ $errors->has('des') ? ' is-invalid' : '' }}" name="des" value="{{ old('des')  ??  $post->des ?? ' '  }}" required>
      <label data-error="wrong" data-success="right" for="defaultForm-email">{{ __('admin.des') }}</label>
    </div>



    <div class="modal-footer d-flex justify-content-center">
      <button class="btn btn-default uploadrealpost" data-id ="{{$post->id}}">{{ __('admin.Postpost') }}</button>
    </div>
  </div>
</form>
</div>
@endsection