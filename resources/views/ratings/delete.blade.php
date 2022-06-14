@push('additional-js')
  <script>
    $('#rating-delete-modal').on('show.bs.modal', function(e) {
      var rating = $(e.relatedTarget).data('rating');
      $('#rating_delete_id').val(rating.id);
    });
  </script>
@endpush
<div class="modal fade" id="rating-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Delete Rating</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/ratings/delete">
        @csrf
        <input type="hidden" id="rating_delete_id" name="rating_id"/>
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