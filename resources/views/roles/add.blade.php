@php
    $permissions = App\Models\Permission::all();
@endphp

<button 
  type="button" 
  class="btn btn-outline-primary"
  data-toggle="modal" 
  data-target="#add-role-modal"
  style="margin-bottom: 10px;"
>
  <i class="fa fa-plus"></i> Add New Role
</button>
<div class="modal fade" id="add-role-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="add_role_modal">Add New Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/roles/create" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Permissions</label>
              <select name="permissions[]" class="select2" multiple="multiple" data-placeholder="Select permissions" style="width: 100%;" required>
                @foreach ($permissions as $permission)
                  <option value="{{$permission->id}}">{{$permission->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>