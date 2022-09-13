<x-layouts.auth>
  <p class="login-box-msg">Sign in to start your session</p>
  @if (session('status'))
    {{-- <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div> --}}
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif
  <form action="login" method="post">
    @csrf
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
    <div class="row">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="remember">
          <label for="remember">
            Remember Me
          </label>
        </div>
      </div>

      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </div>
    </div>
  </form>
  {{-- @foreach ($errors->all() as $error)
  <ul>
    <li>
      <p style="color: red">{{ $error }}</p>
    </li>
  </ul>
  @endforeach --}}

  <p class="mb-1">
    <a href="/forgot-password">I forgot my password</a>
  </p>
  {{-- <p class="mb-0">
    <a href="/register" class="text-center">Register a new membership</a>
  </p> --}}
</x-layouts.auth>