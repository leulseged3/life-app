@push('additional-css')
  <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
@endpush
@push('additional-js')
  <script src="{{ URL::asset('js/select2.full.min.js') }}"></script>

  <script>
    $('.select2').select2();
  </script>

  <script>
    $('#article-edit-modal').on('show.bs.modal', function(e) {
      var article = $(e.relatedTarget).data('article');
      $('#article_title').text("Edit " + article.title);
      $('#title').val(article.title);
      $('#description').val(article.description);
      $('#article_id').val(article.id);
      // $('#title').val(article.title);
      // $('#title').val(article.title);
      
      let loadFile = function(event) {
        let image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
      };
    });
  </script> 

@endpush
@php
  $categories = App\Models\Category::all();
@endphp
<div class="modal fade" id="article-edit-modal" tabindex="-1" role="dialog" aria-labelledby="articleEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" ><b id="article_title">Edit User</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form method="POST" action="/articles/edit" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="article_id" name="article_id"/>
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>

            <div class="form-group">
              <label>Categories</label>
              <select name="categories[]" class="select2" multiple="multiple" data-placeholder="Select a category" style="width: 100%;">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
              </select>
            </div>
  
            <img id="output" width="200"/>
  
            <div class="form-group">
              <label for="feature_image">Feature Image</label>
              <input type="file" class="form-control-file" id="feature_image" name="feature_image" onchange="loadFile(event)">
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" rows="4" name="description"></textarea>
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