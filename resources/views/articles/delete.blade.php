@push('additional-js')
  <script>
    $('#article-delete-modal').on('show.bs.modal', function(e) {
      var article = $(e.relatedTarget).data('article');
      // $('#article_delete_title').text("Delete " + user.first_name + " " + user.last_name + "");
      $('#article_delete_id').val(article.id);
    });
  </script>
@endpush
<div class="modal fade" id="article-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_delete_title">Delete Article</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/articles/delete">
        @csrf
        <input type="hidden" id="article_delete_id" name="article_id"/>
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