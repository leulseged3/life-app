@push('additional-js')
  <script>
    $('#user-delete-modal').on('show.bs.modal', function(e) {
      var user = $(e.relatedTarget).data('user');
      $('#user_delete_title').text("Delete " + user.first_name + " " + user.last_name + "");
      $('#user_delete_id').val(user.id);
    });
  </script>
@endpush
<div class="modal fade" id="user-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="user_delete_title">Delete User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/users/delete">
        @csrf
        <input type="hidden" id="user_delete_id" name="user_id"/>
        <div class="modal-body">
          <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>