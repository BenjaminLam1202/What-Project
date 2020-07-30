@extends('admin.functions.addUser')
@extends('layouts.menu')
@section('contenter')
<div class="container">

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="text-center">
      <figure>
        <img  src="{{asset(Session::get('image_status'))}}" class="w-10" alt="">
        <figcaption>{{ __('admin.admin') }}</figcaption>
      </figure>
    </div>
  </div>
</div> 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table>
                  <tr>
                    <td>
                      <div class="card-header">{{ __('admin.numb') }} : {{DB::table('users')->count()}}</div>
                    </td>
                    <td>
                    <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalRegisterForm"> {{ __('admin.newUser') }} </button>
                    </td>
                    <td>
                    <div class="row justify-content-center">
                      <div class="col-md-8">
                            <a class="btn btn-info" href="{{ route('admin.export') }}">{{ __('admin.export') }}</a>
                      </div>
                    </div>    

                  </tr>
                </table>
                <table class="table table-striped">

                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">{{ __('admin.Name') }}</th>
                      <th scope="col">{{ __('admin.createAt') }}</th>
                      <th scope="col">{{ __('admin.Email') }}</th>
                      <th scope="col">{{ __('admin.Role') }}</th>
                      <th scope="col">#</th>
                    </tr>
                  </thead>
                  <tbody class="thistb" id="thistb">
                    @foreach($users as $user)
                    <tr>
                      <td id="display{{$user->id}}">{{$user->name}}</td>
                      <td>{{$user->created_at}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->role_id}}</td>
                      <td class="text-center">
                          <button type="button" class='btn btn-info btn-xs' data-toggle="modal" data-target=".myModaluser{{$user->id}}"><span class="glyphicon glyphicon-edit"></span>{{ __('admin.Edit') }}</button>
                        @if(Auth::user()->id != $user->id)
                          <button class="btn btn-danger btn-xs" onClick="$(this).closest('tr').fadeOut(800,function(){$(this).remove();});" type="button" ><span class="glyphicon glyphicon-remove"></span><a href="/admin/delete/{{$user->id}}"> {{ __('admin.Delete') }}</a></button>
                        @endif
                    </td>
                      <div id="myModaluser{{$user->id}}" class="modal fade myModaluser{{$user->id}}" role="dialog">
                        
                        <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">{{ __('admin.EditUser') }}</h4>
                          </div>

                          <div class="modal-body">
                            <img src="{{$user->photo1}}" class="w-5 text-center">
                            <div>

                              <form action="{{ route('admin.updateuser') }}" method="post" class="my_topic_change_form{{$user->id}}" id="my_topic_change_form{{$user->id}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('admin.Rename') }}</label>
                                <input type="text" class="form-control" name="name" aria-describedby="noticeHelp" value="{{$user->name}}" placeholder="{{$user->name}}"> 
                                <label for="exampleInputEmail1">{{ __('admin.Address') }}</label>
                                <input type="text" class="form-control" name="address" value="{{$user->address}}" aria-describedby="noticeHelp" placeholder="{{$user->address??'yours address?'}}"> 
                                <label for="exampleInputEmail1">{{ __('admin.Email') }}</label>
                                <input type="email" class="form-control" name="email" aria-describedby="noticeHelp" value="{{ $user->email}}" placeholder="{{$user->email}}" readonly>
                                <label for="exampleInputEmail1">{{ __('admin.Avatar') }}</label>
                                <input type="file" class="form-control" name="file" aria-describedby="noticeHelp" value="{{$user->name}}" placeholder="{{$user->name}}">
                                <label for="exampleInputEmail1">{{ __('admin.Role') }}</label> 
                                  <select id="role" type="role" name="role" class="browser-default custom-select">
                                    @foreach(App\Role::all() as $role)
                                   <option value="{{$role->id}}">{{$role->name}}</option>
                                   @endforeach
                                 </select>
                                 <div class="modal-footer d-flex justify-content-center">
                                <input type="hidden" name="id" value="{{ $user->id}}">
                                <button type="submit" class="btn btn-primary">{{ __('admin.Change') }}</button> 
                              </form>

                            </div>
                           
                            </div>
                          </div>

                        </div>

                      </div>

                    </tr>
                    @endforeach
                  </tbody>
                  </table>

                </div>
          <div class="container">
          <label for="page">{{ __('admin.Sort') }}</label>
          <select name="page" class="lala form-control">
            <option name="sortpage" value="a">a</option>
            <option name="sortpage"value="b">b</option>
            <option name="sortpage"value="c">c</option>
            <option name="sortpage"value="d">d</option>
            <option name="sortpage"value="e">e</option>
            <option name="sortpage"value="f">f</option>
            <option name="sortpage"value="g">g</option>
            <option name="sortpage"value="h">h</option>
            <option name="sortpage"value="i">i</option>
            <option name="sortpage"value="j">j</option>
            <option name="sortpage"value="k">k</option>
            <option name="sortpage"value="l">l</option>
            <option name="sortpage"value="m">m</option>
            <option name="sortpage"value="n">n</option>
            <option name="sortpage"value="o">o</option>
            <option name="sortpage"value="p">p</option>
            <option name="sortpage"value="q">q</option>
            <option name="sortpage"value="r">r</option>
            <option name="sortpage"value="s">s</option>
            <option name="sortpage"value="t">t</option>
            <option name="sortpage"value="u">u</option>
            <option name="sortpage"value="v">v</option>
            <option name="sortpage"value="w">w</option>
            <option name="sortpage"value="x">x</option>
            <option name="sortpage"value="y">y</option>
            <option name="sortpage"value="z">z</option>
            <option name="sortpage"value="" selected>all</option>
          </select>
        </div>
            </div>
        </div>
    </div>
<div class="container">
{{ $users->links() }}
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript">
  $('.lala').on('change', function(){
    var id = $("select[name=page]").val();
        console.log(id);
        var post_url ='/admin/manager/'+id;
        console.log(post_url);
   window.location.href = post_url;
      
});
</script>
@endsection