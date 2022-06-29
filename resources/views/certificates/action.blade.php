@push('additional-js')
  <script>
    $('#certificate-action-modal').on('show.bs.modal', function(e) {
      var certificate = $(e.relatedTarget).data('certificate');
      var status =  $(e.relatedTarget).data('status');
      $('#certificate_action_title').text(status + " certificate");
      $('#certificate_id').val(certificate.id);
      $('#certificate_status').val(status);
      $('#user_id').val(certificate.user_id);

    });
  </script>
@endpush
<div class="modal fade" id="certificate-action-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="certificate_action_title">Are you sure?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{URL::to('/certificates/action')}}">
        @csrf
        <input type="hidden" id="certificate_id" name="id"/>
        <input type="hidden" id="certificate_status" name="status"/>
        <input type="hidden" id="user_id" name="user_id"/>

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