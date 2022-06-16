@push('additional-js')
  <script>
    $('#article-approve-modal').on('show.bs.modal', function(e) {
      var article = $(e.relatedTarget).data('article');
      $('#article_id').val(article.id);
    });
  </script>
@endpush
<div class="modal fade" id="article-approve-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="article_action_title">Approve Article</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{URL::to('/articles/approve')}}">
        @csrf
        <input type="hidden" id="article_id" name="id"/>
        <div class="modal-body">
          <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>