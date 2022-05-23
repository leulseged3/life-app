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
          <th>Actions</th>
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
            <td class="d-flex" style="justify-content: space-around">
              <a 
                href="#" 
                data-toggle="modal" 
                data-target="#user-edit-modal"
                data-user="{{$user}}"
              >
                <i class="fas fa-edit" title="Edit" ></i>
              </a>
              <a 
                href="#"
                data-toggle="modal" 
                data-target="#user-delete-modal"
                data-user="{{$user}}"
              >
                <i class="fas fa-trash" title="Delete" style="color: red"></i>
              </a>
            </td>
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
    @include('users.edit')
    @include('users.delete')
  </x-layouts.table>
</x-layouts.app>
