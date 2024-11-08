<!doctype html>
<html lang="en">
   <head>
      <title>Login 04</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="/assets/backend/login/css/style.css">
   </head>
   <body>
      <section class="ftco-section">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6 text-center mb-3">
                   <img src="/assets/backend/login/images/logo.png" alt="" style="width: 120px">

                   <h4 class="heading-section mt-4 font-weight-bold " style="color: #e68565;">
                       HỆ THỐNG XÁC THỰC TỈNH THANH HÓA

                   </h4>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-8">
                  <div class="wrap d-md-flex justify-content-center">
{{--                     <div class="img" style="background-image: url(/assets/backend/login/images/bg-1.jpg);">--}}
{{--                     </div>--}}
                     <div class="login-wrap p-4 p-md-5 w-75">
                        <div class="d-flex">
                           <div class="w-100">
                              <h3 class="mb-4 " >Đăng nhập</h3>
                           </div>
                           <div class="w-100">
                              <p class="social-media d-flex justify-content-end">
                                 <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                 <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                              </p>
                           </div>
                        </div>
                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.login') }}" class="signin-form">
                            @csrf
                           <div class="form-group mb-3">
                              <label class="label" for="name">Tài khoản</label>
                              <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                           </div>
                           <div class="form-group mb-3">
                              <label class="label" for="password">Password</label>
                              <input id="password" type="password" name="password" class="form-control" placeholder="password" required>
                           </div>
                           <div class="form-group">
                              <button type="submit" class="form-control btn btn-primary rounded submit px-3">Đăng nhập</button>
                           </div>
                           <div class="form-group d-md-flex">
                              <div class="w-50 text-left">
                                 <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                 <input type="checkbox" checked>
                                 <span class="checkmark"></span>
                                 </label>
                              </div>
                              <div class="w-50 text-md-right">
                                 <a href="#">Forgot Password</a>
                              </div>
                           </div>
                        </form>
{{--                        <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>--}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <script src="/assets/backend/loginjs/jquery.min.js"></script>
      <script src="/assets/backend/loginjs/popper.js"></script>
      <script src="/assets/backend/loginjs/bootstrap.min.js"></script>
      <script src="/assets/backend/loginjs/main.js"></script>
   </body>
</html>
