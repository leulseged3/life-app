<x-layouts.app currentpage="Specialities">
  @include('specialities.add')
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="row">
    @foreach($specialities as $speciality)
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon">
            <img 
              src="{{ URL::asset('storage/icons/specialities/'.$speciality->icon) }}" 
              alt="" 
              title=""
              style="width: 100px; height: 70px;"
            />
          </span>
          <div class="info-box-content">
            <span class="info-box-text" style="font-weight: bold;">{{$speciality->title}}</span>
            <span class="info-box-text">{{$speciality->description}}</span>
          </div>
          <a 
            href="#"
            data-toggle="modal" 
            data-target="#speciality-delete-modal"
            data-speciality="{{$speciality}}"
          >
            <i class="fa fa-trash-alt" style="color: red;"></i>
          </a>
        </div>
      </div>
    @endforeach
  </div>
  @include('specialities.delete')
</x-layouts.app>