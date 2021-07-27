@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                Change Password
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('changePassword') }}">
                  @csrf

                  @if(Session::has('pass_change'))
                    <div class="alert alert-success">{{ Session::get('pass_change') }}</div>
                  @endif

                  @if(Session::has('pass_error'))
                    <div class="alert alert-danger">{{ Session::get('pass_error') }}</div>
                  @endif
                    
                
                    <div class="form-group col-12">
                      <label for="current_password" class="d-block">Current Password<span class="text-danger">*</span></label>
                      <input id="current_password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="current_password">
                        @error('current_password')
                        <div class="text-danger">* {{ $message }}</div>
                      @enderror
                    </div>
                  
                    
                  
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
              
                  <br>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Change Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>

@endsection