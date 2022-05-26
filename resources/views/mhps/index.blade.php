<x-layouts.app currentpage="Medical Health Professionals">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Medical Health Professionals List</h3>
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
                  data-target="#mhp-delete-modal"
                  data-mhp="{{$mhp}}"
                >
                  <i class="fas fa-trash" title="Delete" style="color: red"></i>
                </a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
  <div class="card-footer clearfix bg-white">
    {{$mhps->links()}}
  </div>
</div>
    @include('mhps.edit')
    @include('mhps.delete')
</x-layouts.app>
