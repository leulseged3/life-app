@push('additional-css')
  <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
@endpush
@push('additional-js')
<script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
  <script>
    $('.select2').select2();

    let loadFile = function(event) {
      let image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
@endpush
@php
    $categories = App\Models\Category::all();
@endphp
<x-layouts.app currentpage="Add Article">
  <div class="row">
    <form class="col-md-8" enctype="multipart/form-data" method="POST" action="/articles/add">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create New Article</h3>
          <div class="card-tools">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            {{-- <span class="badge badge-primary">Label</span> --}}
            {{-- <i class="fa fa-plus"></i> --}}
          </div>
          <!-- /.card-tools -->
        </div>

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
        <div class="card-footer">
          <button type="submit" class="btn btn-block btn-success">Create Article</button>
        </div>
      </div>
    </form>
  </div>
</x-layouts.app>