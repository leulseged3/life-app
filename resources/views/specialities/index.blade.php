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
            {{-- <i class="far fa-envelope"></i> --}}
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
        </div>
      </div>
    @endforeach
  </div>
</x-layouts.app>