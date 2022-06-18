<x-layouts.app currentpage="MHP Details">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              @if($mhp->profile_pic)
                <img 
                  class="profile-user-img img-fluid img-circle"
                  src="{{ URL::asset('storage/profile_pics/'.$mhp->profile_pic) }}" 
                  alt="User profile picture"
                  style="width: 200px;height: 200px;"
                >
              @else
                <img 
                  class="profile-user-img img-fluid img-circle"
                  src="{{ URL::asset('img/profile_avatar.png') }}" 
                  alt="User profile picture"
                  style="width: 200px;height: 200px;"
                >
              @endif
              
            </div>
            <h3 class="profile-username text-center">
              {{$mhp->first_name}} {{$mhp->last_name}}
            </h3>
           
            <h4 class="profile-username text-center" style="font-size: 18px">
              {{"@"}}{{$mhp->username}}
              @if ($mhp->certificate->status == "approved")
                &nbsp;&nbsp;<i class="fas fa-check" title="Mhp is approved" style="color: #099FD7;"></i>
              @endif
            </h4>
            <h5 class="text-muted text-center">{{$mhp->email}}</h5>
            <h5 class="text-muted text-center">{{$mhp->mobile_number}}</h5>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Followers</b> <a class="float-right"><span class="badge badge-primary">{{count($mhp->followers)}}</span></a>
              </li>
              <li class="list-group-item">
                <b>Following</b> <a class="float-right"><span class="badge badge-primary">{{count($mhp->followings)}}</span></a>
              </li>
              <li class="list-group-item">
                <b>Rating</b> <a class="float-right">
                  <span class="badge badge-primary">
                    @if(count($mhp->rating) == 0)
                      0
                    @else
                      {{$mhp->rating[0]->total_ratings/$mhp->rating[0]->number_of_raters}} &nbsp;/ &nbsp;<i class="fas fa-user" title="Rated users" ></i> {{$mhp->rating[0]->number_of_raters}}
                    @endif
                  </span>
                </a>
                {{-- <b>Rating</b> <a class="float-right">{{$mhp->rating[0]->total_ratings/$mhp->rating[0]->number_of_raters}}</a> --}}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
