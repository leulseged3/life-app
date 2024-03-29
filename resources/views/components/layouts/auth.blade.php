
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lifeapp admin</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ URL::asset('css/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/icheck-bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/sweet-alert.min.css') }}">

{{-- <script nonce="738bfa79-e0f9-4583-a615-d7c473e291fa">(function(w,d){!function(a,e,t,r){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zaraz={deferred:[]},a.zaraz.q=[],a.zaraz._f=function(e){return function(){var t=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:t})}};for(const e of["track","set","ecommerce","debug"])a.zaraz[e]=a.zaraz._f(e);a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r),n=e.getElementsByTagName("title")[0];for(n&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.x=Math.random(),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),a.zarazData.q=[];a.zaraz.q.length;){const e=a.zaraz.q.shift();a.zarazData.q.push(e)}z.defer=!0;for(const e of[localStorage,sessionStorage])Object.keys(e).filter((a=>a.startsWith("_zaraz_"))).forEach((t=>{try{a.zarazData["z_"+t.slice(7)]=JSON.parse(e.getItem(t))}catch{a.zarazData["z_"+t.slice(7)]=e.getItem(t)}}));z.referrerPolicy="origin",z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script></head> --}}
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>Life</b>app</h1>
    </div>
    <div class="card-body">
      {{ $slot }}
    </div>
  </div>
</div>


<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="{{ URL::asset('js/sweet-alert.min.js') }}"></script>

@if(!empty($errors->all()))
  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    // if(sess)
    Toast.fire({
      icon: 'error',
      title: "{{ $errors->all()[0] }}"
    });
  </script>
@endif
<script>
  console.log("hmm")
  const togglePassword = document
      .querySelector('#togglePassword');

  const password = document.querySelector('#password');
  // console.log("hmm")
  togglePassword.addEventListener('click', () => {

      // Toggle the type attribute using
      // getAttribure() method
      const type = password
          .getAttribute('type') === 'password' ?
          'text' : 'password';
            
      password.setAttribute('type', type);

      // Toggle the eye and bi-eye icon
      // this.classList.toggle('fa-eye');
      if(togglePassword.classList[1] === 'fa-eye-slash') {
        togglePassword.classList.remove('fa-eye-slash');
        togglePassword.classList.add('fa-eye');
      } else {
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');
      }
      console.log(togglePassword.classList[1])
  });
</script>
</body>
</html>
