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