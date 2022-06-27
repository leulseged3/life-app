@php
    $roles = App\Models\Role::all();
@endphp
@push('additional-js')
  <script>
    $('#account-edit-modal').on('show.bs.modal', function(e) {
      let account = $(e.relatedTarget).data('account');
      $('#account_id').val(account.id);
    });
  </script> 
@endpush
<div class="modal fade" id="account-edit-modal" tabindex="-1" role="dialog" aria-labelledby="accountEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b id="account_title">Edit accounts</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/accounts/edit">
        @csrf
        <input type="hidden" id="account_id" name="account_id"/>
        <div class="modal-body">
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