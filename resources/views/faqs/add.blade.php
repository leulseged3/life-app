<button 
  type="button" 
  class="btn btn-outline-primary"
  data-toggle="modal" 
  data-target="#add-faq-modal"
  data-backdrop="static" 
  data-keyboard="false"
  style="margin-bottom: 10px;"
>
  <i class="fa fa-plus"></i> Add New FAQ
</button>
<div class="modal fade" id="add-faq-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mhp_delete_title">Add New FAQ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/faqs/create" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="question">Question</label>
              <textarea class="form-control" id="question" rows="3" name="question" required></textarea>
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="answer">Answer</label>
              <textarea class="form-control" id="answer" rows="4" name="answer" required></textarea>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="image" class="form-label">Image</label>
              <div class="input-group">
                {{-- <div class="input-group-prepend">
                  <span class="input-group-text">Upload</span>
                </div> --}}
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image" required>
                  <label class="custom-file-label" for="inputGroupFile01" >Choose Picture</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>