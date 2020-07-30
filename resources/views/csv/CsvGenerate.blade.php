@extends('layouts.menu')
@section('contenter')

<div class="container">
  <table class="table table-striped text-center">
  <thead>
    <tr>
      <th>Email</th>
      <th>FullName</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr>
        <td>{{$user->email ?? 'NULL'}}</td>
        <td>{{$user->name ?? 'NULL'}}</td>
        <td>{{$user->address ?? 'NULL'}}</td>
      </tr>
    @endforeach
  </tbody>
  </table>
  {{$users->links()}}
  <div class="container">
    <label for="page">Sort</label>

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

    <a class="btn btn-info" href="{{ route('admin.export') }}"> Export File</a>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript">
  $('.lala').on('change', function(){
    var id = $("select[name=page]").val();
        console.log(id);
        var post_url ='/admin/sort/'+id;
        console.log(post_url);
   window.location.href = post_url;
      
});
</script>
@endsection
