<x-layouts.app currentpage="Users">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Users List</h3>
      </div>
      <div class="card-body">
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
                <td>
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
                    style="margin-left: 30px;"
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
      </div>
      <div class="card-footer clearfix bg-white">
        {{$users->links()}}
      </div>
    </div>
    @include('users.edit')
    @include('users.delete')
</x-layouts.app>
