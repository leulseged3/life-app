<x-layouts.app currentpage="Categories">
  @include('categories.add')
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="row">
    @foreach($categories as $category)
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon">
            {{-- <i class="far fa-envelope"></i> --}}
            <img 
              src="{{ URL::asset('storage/icons/'.$category->icon) }}" 
              alt="" 
              title=""
              style="width: 100px; height: 70px;"
            />
          </span>
          <div class="info-box-content">
            <span class="info-box-text" style="font-weight: bold;">{{$category->title}}</span>
            <span class="info-box-text">{{$category->description}}</span>
          </div>
          <a 
            href="#"
            data-toggle="modal" 
            data-target="#category-delete-modal"
            data-backdrop="static" 
            data-keyboard="false"
            data-category="{{$category}}"
          >
            <i class="fa fa-trash-alt" style="color: red;"></i>
          </a>
        </div>
      </div>
    @endforeach
  </div>
  @include('categories.delete')
</x-layouts.app>