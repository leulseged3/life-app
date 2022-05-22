<x-layouts.app currentpage="Users">
  <x-layouts.table title="Users">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Mobile No</th>
          <th>Is MHP</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->mobile_number}}</td>
            <td>{{$user->is_mhp ? 'Yes' : 'No'}}</td>
        </tr>
        @endforeach
      </tbody>
      {{-- <tfoot>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Mobile No</th>
        <th>Is MHP</th>
      </tr>
      </tfoot> --}}
    </table>
  </x-layouts.table>
</x-layouts.app>
