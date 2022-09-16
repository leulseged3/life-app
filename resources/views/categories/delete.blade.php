@push('additional-js')
  <script>
    $('#category-delete-modal').on('show.bs.modal', function(e) {
      var category = $(e.relatedTarget).data('category');
      $('#category_delete_title').text("Delete " + category.title.substring(0, 35) + " Category");
      $('#category_delete_id').val(category.id);
    });
  </script>
@endpush
<div class="modal fade" id="category-delete-modal" >
  <div class="modal-dialog">
    <div class="modal-content" style="overflow-x: hidden;">
      <div class="modal-header">
        <h4 class="modal-title" id="category_delete_title">Delete Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/categories/delete">
        @csrf
        <input type="hidden" id="category_delete_id" name="category_id"/>
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