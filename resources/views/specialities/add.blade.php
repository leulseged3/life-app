<button 
  type="button" 
  class="btn btn-outline-primary"
  data-toggle="modal" 
  data-target="#add-category-modal"
  style="margin-bottom: 10px;"
>
  <i class="fa fa-plus"></i> Add New Speciality
</button>
<div class="modal fade" id="add-category-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mhp_delete_title">Add New Speciality</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/specialities/create" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="description">Description</label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="icon" class="form-label">Icon</label>
              <div class="input-group">
                <input 
                  type="file" 
                  id="inputProfilePic" 
                  name="icon">
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