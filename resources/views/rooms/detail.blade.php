<x-layouts.app currentpage="Room Detail">
  {{-- <p>{{$room}}</p> --}}
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <h5>{{$room->title}}</h5>
        </div>
        <div class="card-body">
          <div style="display: flex; flex-direction: row; align-items: center;">
            @if ($room->user->profile_pic)
              <img 
                src="{{ URL::asset('storage/profile_pics/'.$room->user->profile_pic) }}" 
                alt="" 
                title=""
                style="width: 40px; height: 40px; border-radius: 20px;"
              />
            @else
              <img 
                src="{{ URL::asset('img/profile_avatar.png') }}" 
                alt="" 
                title=""
                style="width: 40px; height: 40px; border-radius: 20px;"
              />
            @endif
            <div style="flex-grow: 1; margin-left: 5px;">
              <a style="font-size: 18px" href="/mhps/{{$room->user->id}}">{{$room->user->first_name}} {{$room->user->last_name}}</a>
            </div>
            <div>
              <span class="badge badge-primary">
                Joined <i class="nav-icon fas fa-users" style="margin-right: 10px"></i>{{count($room->users)}}
              </span>
              
              <span class="badge badge-primary">
                Limit <i class="nav-icon fas fa-hand-paper" style="margin-right: 10px"></i> {{$room->limit}}
              </span>
            </div>
          </div>
          <hr />
          <div class="row">
            @foreach($room->categories as $category)
            <div class="col-md-3 col-sm-6 col-12">
              <div class="row shadow-sm" style="display: flex; align-items: center;padding: 5px;margin-right: 5px;">
                <img 
                  src="{{ URL::asset('storage/icons/'.$category->icon) }}" 
                  alt="" 
                  title=""
                  style="width: 40px; height: 40px; border-radius: 20px;"
                />
                <h5 style="font-size: 16px; margin-left: 15px;">{{$category->title}}</h5>
              </div>              
            </div>
            @endforeach
          </div>
          <hr />
          <div>
            <p>{{$room->description}}</p>
          </div>
          <hr />
          <div>
            <i class="fas fa-calendar" aria-hidden="true"> {{date("F j, Y",strtotime($room->date))}}</i>
            <i style="margin-left: 40px;" class="fas fa-clock" aria-hidden="true"> {{date("F j, Y",strtotime($room->date))}}</i>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>