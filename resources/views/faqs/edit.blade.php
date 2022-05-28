@push('additional-js')
  <script>
    $('#faq-edit-modal').on('show.bs.modal', function(e) {
      let faq = $(e.relatedTarget).data('faq');
      $('#edit_question').val(faq.question);
      $('#edit_answer').val(faq.answer);
      $('#faq_id').val(faq.id);
      console.log(faq.question)
    });
  </script> 
@endpush
<div class="modal fade" id="faq-edit-modal" tabindex="-1" role="dialog" aria-labelledby="faqEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><b id="faq_title">Edit FAQs</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/faqs/edit" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="faq_id" name="faq_id"/>
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label for="edit_question">Question</label>
              <textarea class="form-control" id="edit_question" rows="4" name="question"></textarea>
            </div>
            <div class="form-group">
              <label for="edit_answer">Answer</label>
              <textarea class="form-control" id="edit_answer" rows="4" name="answer"></textarea>
            </div>
            <div class="form-group">
              <label for="edit_image">Image</label>
              <input type="file" class="form-control-file" id="edit_image" name="image">
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