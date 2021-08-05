<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Ticketing System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}"/>

        <!-- App css -->
        <link href="{{ asset('/login/css/bootstrap-material.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('/login/css/app-material.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('/login/css/bootstrap-material-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('/login/css/app-material-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

        <!-- icons -->
        <link href="{{ asset('/login/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <span class="logo-lg logo logo-dark text-center text-muted">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="" height="30"> Ticketing System
                                        </span>
                                    </div>
                                </div>

                                <p class="text-muted mb-4 mt-3">Enter your email address and password to access.</p>

                                @if(Session::has('login_error'))
                                  <div class="alert alert-danger">{{ Session::get('login_error') }}</div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="Enter your email" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="{{ route('forgotPassword') }}" class="text-small">
                                      Forgot your password?
                                    </a>
                                </p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2020 - <script>document.write(new Date().getFullYear())</script> &copy; PaceNet Ticketing System. 
        </footer>

        <!-- Vendor js -->
        <script src="{{ asset('/login/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('/login/js/app.min.js') }}"></script>

        <script type="text/javascript">

            document.addEventListener('contextmenu', event => event.preventDefault());
     
            document.onkeydown = function (e) {
         
                // disable F12 key
                if(e.keyCode == 123) {
                    return false;
                }
         
                // disable I key
                if(e.ctrlKey && e.shiftKey && e.keyCode == 73){
                    return false;
                }
         
                // disable J key
                if(e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                    return false;
                }
         
                // disable U key
                if(e.ctrlKey && e.keyCode == 85) {
                    return false;
                }
            }
         
        </script>
        
    </body>
</html>