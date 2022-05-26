@push('additional-js')
  <script>
    $('#faq-delete-modal').on('show.bs.modal', function(e) {
      var faq = $(e.relatedTarget).data('faq');
      // $('#article_delete_title').text("Delete " + user.first_name + " " + user.last_name + "");
      $('#faq_delete_id').val(faq.id);
    });
  </script>
@endpush
<div class="modal fade" id="faq-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="faq_delete_title">Delete FAQ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/faqs/delete">
        @csrf
        <input type="hidden" id="faq_delete_id" name="faq_id"/>
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