@push('additional-css')
  <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
@endpush
@push('additional-js')
<script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
  <script>
    $('.select2').select2();

    let loadFile = function(event) {
      let image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
@endpush
<x-layouts.app currentpage="Roles">
  @include('roles.add')
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Roles List</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
            <tr>
              <td>{{$role->name}}</td>
              <td>
                @foreach ($role->permissions as $permission)
                
                <span class="badge badge-success">{{$permission->name}}</span>
                @endforeach
              </td>
              
              <td>
                <a 
                  href="#"
                  data-toggle="modal" 
                  data-target="#role-delete-modal"
                  data-role="{{$role}}"
                  data-backdrop="static" 
                  data-keyboard="false"
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
      {{$roles->links()}}
    </div>
  </div>
  @include('roles.delete')
</x-layouts.app>
