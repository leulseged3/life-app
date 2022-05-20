<x-layouts.auth>
  <p class="login-box-msg">Reset Password</p>
  <form action="/reset-password" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token')}}"/>
    <div class="input-group mb-3">
      <input type="email" class="form-control" placeholder="Email" name="email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Password" name="password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Reset</button>
      </div>
    </div>
  </form>
  @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach
</x-layouts.auth>
