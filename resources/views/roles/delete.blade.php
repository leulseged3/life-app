@push('additional-js')
  <script>
    $('#role-delete-modal').on('show.bs.modal', function(e) {
      var role = $(e.relatedTarget).data('role');
      $('#role_delete_id').val(role.id);
    });
  </script>
@endpush
<div class="modal fade" id="role-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Delete role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/roles/delete">
        @csrf
        <input type="hidden" id="role_delete_id" name="role_id"/>
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