<button 
  type="button" 
  class="btn btn-outline-primary"
  data-toggle="modal" 
  data-target="#add-category-modal"
  style="margin-bottom: 10px;"
>
  <i class="fa fa-plus"></i> Add New Category
</button>
<div class="modal fade" id="add-category-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mhp_delete_title">Add New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/categories/create">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-7">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="form-group col-md-5">
              <label for="description">Icon</label>
              <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="description">Description</label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Description">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </form>
    </div>
  </div>
</div>