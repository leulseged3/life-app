@push('additional-js')
  <script>
    $('#speciality-delete-modal').on('show.bs.modal', function(e) {
      var speciality = $(e.relatedTarget).data('speciality');
      $('#speciality_delete_title').text("Delete " + speciality.title + " Speciality");
      $('#speciality_delete_id').val(speciality.id);
    });
  </script>
@endpush
<div class="modal fade" id="speciality-delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="speciality_delete_title">Delete Speciality</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/specialities/delete">
        @csrf
        <input type="hidden" id="speciality_delete_id" name="speciality_id"/>
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