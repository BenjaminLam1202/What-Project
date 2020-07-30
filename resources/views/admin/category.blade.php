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
        <th>{{ __('admin.id') }}</th>
        <th>{{ __('admin.name') }}</th>
        <th>{{ __('admin.number') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <div>
          <td>{{$category->id}}</td>
        </div>
        <td>{{$category->name}}</td>
        <td>{{ DB::table('posts')->where('category_id',$category->id)->count()}}</td>
        <td class="text-center"><a class='btn btn-info btn-xs'  href="#" ><span class="glyphicon glyphicon-edit"></span> {{ __('admin.Edit') }}</a> <a  href="#"  class="btn btn-danger btn-xs" onClick="$(this).closest('tr').fadeOut(800,function(){$(this).remove();});" type="button"><span class="glyphicon glyphicon-remove"></span> {{ __('admin.Delete') }}</a></td>
      </div>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $categories->links() }}
</div>

@endsection