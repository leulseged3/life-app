@push('additional-css')
  <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
@endpush
@push('additional-js')
<script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
  <script>
    $('.select2').select2();
  </script>
@endpush
<x-layouts.app currentpage="Add Article">
  <div class="row">
    <form class="col-md-8">
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
            <label for="description">Title</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
          </div>
          <div class="form-group">
            <label>Categories</label>
            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
              <option>Alabama</option>
              <option>Alaska</option>
              <option>California</option>
              <option>Delaware</option>
              <option>Tennessee</option>
              <option>Texas</option>
              <option>Washington</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Feature Image</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-block btn-success">Create Article</button>
        </div>
      </div>
    </form>
  </div>
</x-layouts.app>