<x-layouts.app currentpage="Categories">
  @include('categories.add')
  <div class="row">
    @foreach($categories as $category)
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info">
            <i class="far fa-envelope"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text" style="font-weight: bold;">{{$category->title}}</span>
            <span class="info-box-text">{{$category->description}}</span>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</x-layouts.app>