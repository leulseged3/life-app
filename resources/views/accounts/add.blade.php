@php
    $roles = App\Models\Role::all();
@endphp
<button 
  type="button" 
  class="btn btn-outline-primary"
  data-toggle="modal" 
  data-target="#add-account-modal"
  style="margin-bottom: 10px;"
>
  <i class="fa fa-plus"></i> Add New Account
</button>
<div class="modal fade" id="add-account-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mhp_delete_title">Add New Account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/accounts/create">
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
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Role</label>
              <select name="role" class="form-control"  data-placeholder="Select a Role" required>
                @foreach ($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
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