<x-layouts.app currentpage="Medical Health Professionals">
  <x-layouts.table title="Medical Health Professionals List">
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
        @foreach($mhps as $mhp)
          <tr>
            <td>{{$mhp->first_name}}</td>
            <td>{{$mhp->last_name}}</td>
            <td>{{$mhp->email}}</td>
            <td>{{$mhp->username}}</td>
            <td>{{$mhp->mobile_number}}</td>
            <td class="d-flex" style="justify-content: space-around">
              <a 
                href="#" 
                data-toggle="modal" 
                data-target="#mhp-edit-modal"
                data-mhp="{{$mhp}}"
              >
                <i class="fas fa-edit" title="Edit" ></i>
              </a>
              <a 
                href="#"
                data-toggle="modal" 
                data-target="#user-delete-modal"
                data-mhp="{{$mhp}}"
              >
                <i class="fas fa-trash" title="Delete" style="color: red"></i>
              </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @include('mhps.edit')
  </x-layouts.table>
</x-layouts.app>
