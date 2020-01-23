<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>{{$Title}}</title>
  
  <link rel="icon" href="{{ asset('public')}}/favicon.ico" type="image/x-icon">
  <link href="{{ asset('public/Admin')}}/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="{{ asset('public/Admin')}}/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('public/Admin')}}/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('public/Admin')}}/assets/css/app-style.css" rel="stylesheet"/>
  <link href="{{ asset('public/Admin')}}/assets/css/local.css" rel="stylesheet"/>
  
</head>
<body>

  <input type="hidden" name="url" id="url" value='{{url("Admin/")}}'>
  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

  <div id="wrapper">
    <div class="card-authentication2 mx-auto my-5 animated slideInLeft">
      <div class="card-group">
        <div class="card mb-0">
          <div class="bg-signin2"></div>
          <div class="card-img-overlay rounded-left my-5">
            <h2 class="text-white">Lorem</h2>
            <h1 class="text-white">Ipsum Dolor</h1>
            <p class="card-text text-white pt-3">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
          </div>
        </div>
        <div class="card mb-0 bg-dark">
          <div class="card-body">
            <div class="card-content p-3">
              <div class="text-center">
                <img src="{{ asset('public/logo.png')}}"/>
              </div>
              <div class="card-title text-uppercase text-center text-white py-2">User Login</div>
              <span id="Login_msg"></span>
              <form class="color-form" id="LoginForm" name="LoginForm" method="post">
                <input type="hidden" id="referer_url" value="<?=@$_SERVER['HTTP_REFERER']?>">
                <div class="form-group">
                  <div class="position-relative has-icon-left">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    <div class="form-control-position">
                      <i class="icon-user"></i>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="position-relative has-icon-left">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    <div class="form-control-position">
                      <i class="icon-lock"></i>
                    </div>
                  </div>
                </div>
                <div class="form-row mr-0 ml-0">
                  <div class="form-group col-12 text-right">
                    <a href="{{route('ResetPassword')}}">Reset Password</a>
                  </div>
                </div>
                <button type="submit" id="LoginBtn" class="btn btn-success btn-block">Sign In</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
  </div>
  <script src="{{ asset('public/Admin')}}/assets/js/jquery.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/js/popper.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/js/bootstrap.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/js/waves.js"></script>

  
  <script src="{{ asset('public/Admin')}}/assets/js/jquery.validate.min.js"></script>
  <script src="{{ asset('public/Admin')}}/assets/js/additional-methods.min.js"></script>  
  <script src="{{ asset('public/Admin')}}/assets/validation/UserLogin.js"></script>  

</body>
</html>
