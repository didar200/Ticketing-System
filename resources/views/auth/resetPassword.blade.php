<!DOCTYPE html>
<html lang="en">


<!-- auth-forgot-password.html  21 Nov 2019 04:05:02 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Ticketing System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/logo.png') }}" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container" style="margin-top: 150px; ">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Reset Password</h4>
              </div>
              <div class="card-body">
                
                <form method="POST" action="{{ route('resetPasswordProcess') }}">
                  @csrf

                  @if(Session::has('pass_change'))
                    <div class="alert alert-success">{{ Session::get('pass_change') }}</div>
                  @endif

                  <input type="hidden" name="id" value="{{ $user->id }}">

                  <div class="form-group col-12">
                      <label for="new_password" class="d-block">New Password<span class="text-danger">*</span></label>
                      <input id="new_password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="new_password">
                        @error('new_password')
                        <div class="text-danger">* {{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-12">
                      <label for="password_confirmation" class="d-block">Confirm Password<span class="text-danger">*</span></label>
                      <input id="password_confirmation" type="password" class="form-control" name="new_password_confirmation">
                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Change Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>


<!-- auth-forgot-password.html  21 Nov 2019 04:05:02 GMT -->
</html>