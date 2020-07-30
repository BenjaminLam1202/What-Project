@extends('layouts.app')
@section('content')

<div class="container">
<div class="container" style="background:grey;border-radius: 20px;" >
  <br>
  <br>
  <div class="row">
    <div class="col">

      <div class="row">
        <div class="col">
         <h3><strong>Author:</strong><a href="/profile/{{$post->user->id}}"> {{$post->user->name}}</a></h3>
         <h3><strong>Title:</strong> {{$post->title}}</h3>
         <p>category : <a href="/{{$post->category}}"> {{$post->category}}</a></p>
         <br>
         <br>
         <p><strong>Description:</strong> {{$post->des}}</p>

       </div>



    </div>

    <br>
    <br>


   </div>
 </div>
</div>
</div>







   @endsection