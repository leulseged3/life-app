@push('additional-js')
  <script>
    $('#ticket-reply-modal').on('show.bs.modal', function(e) {
      var ticket = $(e.relatedTarget).data('ticket');
      $('#ticket_reply_id').val(ticket.id);
    });
  </script>
@endpush
<div class="modal fade" id="ticket-reply-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Reply Ticket</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/tickets/reply">
        @csrf
        <input type="hidden" id="ticket_reply_id" name="ticket_id"/>
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label for="edit_question">Reply</label>
              <textarea class="form-control" id="reply" rows="4" name="reply" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>