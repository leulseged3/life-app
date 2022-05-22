@push('additional-js')
  <script>
    $('#user-edit-modal').on('show.bs.modal', function(e) {
      var user = $(e.relatedTarget).data('user');
      $('#user_title').text("Edit " + user.first_name + " " + user.last_name + "'s Profile");
      $('#first_name').val(user.first_name);
      $('#last_name').val(user.last_name);
      $('#email').val(user.email);
      $('#username').val(user.username);
      $('#user_id').val(user.id);
      $('#mobile_number').val(user.mobile_number);
      $('#is_mhp').val("yes");
    });
  </script>
@endpush
<div class="modal fade" id="user-edit-modal" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" ><b id="user_title">Edit User</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form method="POST" action="/users/edit" id="add-student-form">
        @csrf
        <input type="hidden" id="user_id" name="user_id"/>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group col-md-6">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Father Name">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" disabled class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="username">Username</label>
              <input type="text" disabled class="form-control" id="username" name="username" placeholder="Username">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="mobile_number">Phone Number</label>
              <input type="tel" disabled class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
            </div>
          </div>
          <br/>
        </div>
        <div class="modal-footer">
          <button type="submit" id="add_student" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>