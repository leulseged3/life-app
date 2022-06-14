<x-layouts.app currentpage="Admin Profile">
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              @if (Auth::user()->profile_pic)
                <img 
                  class="profile-user-img img-fluid img-circle"
                  src="{{ URL::asset('storage/profile_pics/'.Auth::user()->profile_pic) }}" 
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
            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
            <p class="text-muted text-center">{{Auth::user()->email}}</p>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <h3>Update Profile</h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="/profile/update" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Upload Profile Picture</label>
                <div class="col-sm-6">
                  <input type="file" class="form-control" id="inputProfilePic" name="profile_pic">
                </div>
              </div>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-header p-2">
            <h3>Change Password</h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" method="POST" action="/profile/update">
              @csrf
              {{-- <div class="form-group row">
                <label for="inputExperience" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputCurrentPassword" placeholder="*******" name="current_password">
                </div>
              </div> --}}

              <div class="form-group row">
                <label for="inputExperience" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputNewPassword" placeholder="*******" name="new_password">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputExperience" class="col-sm-2 col-form-label">Confirm New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputConfirmNewPassword" placeholder="*******" name="confirm_new_password">
                </div>
              </div>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Change</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
