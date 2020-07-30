@extends('admin.post.create')
@extends('layouts.menu')
@section('contenter')
<div class="container-fluid">
  <div class="pt-5">
        <button href="{{ route('admin.post.create') }}" type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalLoginForm"> {{ __('admin.newPost') }} </button>
      </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>{{ __('admin.title') }}</th>
        <th>{{ __('admin.des') }}</th>
        <th>{{ __('admin.category') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
      <tr>
        <div>
          <td><a  href="/api/admin/article/detail/post/{{ $post->id }}">{{$post->title}}</a></td>
        </div>
        <td>{{$post->des}}</td>
        <td>{{$post->category->name}}</td>
        <td class="text-center"><a class='btn btn-info btn-xs'  href="/admin/po/{{$post->id}}/edit" ><span class="glyphicon glyphicon-edit"></span> {{ __('admin.Edit') }}</a> <a  href="/admin/d/{{$post->id}}"  class="btn btn-danger btn-xs" onClick="$(this).closest('tr').fadeOut(800,function(){$(this).remove();});" type="button"><span class="glyphicon glyphicon-remove"></span> {{ __('admin.Delete') }}</a></td>
      </div>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $posts->links() }}
</div>

@endsection