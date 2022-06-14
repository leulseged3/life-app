@push('additional-js')
  <script>
    $('#ticket-delete-modal').on('show.bs.modal', function(e) {
      var ticket = $(e.relatedTarget).data('ticket');
      $('#ticket_delete_id').val(ticket.id);
    });
  </script>
@endpush
<div class="modal fade" id="ticket-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Delete Ticket</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/tickets/delete">
        @csrf
        <input type="hidden" id="ticket_delete_id" name="ticket_id"/>
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