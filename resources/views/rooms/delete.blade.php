@push('additional-js')
  <script>
    $('#room-delete-modal').on('show.bs.modal', function(e) {
      var room = $(e.relatedTarget).data('room');
      $('#room_delete_id').val(room.id);
    });
  </script>
@endpush
<div class="modal fade" id="room-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Delete room</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/rooms/delete">
        @csrf
        <input type="hidden" id="room_delete_id" name="room_id"/>
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