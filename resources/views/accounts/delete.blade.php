@push('additional-js')
  <script>
    $('#account-delete-modal').on('show.bs.modal', function(e) {
      var account = $(e.relatedTarget).data('account');
      $('#account_delete_id').val(account.id);
    });
  </script>
@endpush
<div class="modal fade" id="account-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="account_delete_title">Delete account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/accounts/delete">
        @csrf
        <input type="hidden" id="account_delete_id" name="account_id"/>
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