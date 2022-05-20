<x-layouts.auth>
  <p class="login-box-msg">Reset Password</p>
  @if (session('status'))
    {{-- <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div> --}}
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif
  <form action="forgot-password" method="post">
    @csrf
    <div class="input-group mb-3">
      <input type="email" class="form-control" placeholder="Email" name="email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
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