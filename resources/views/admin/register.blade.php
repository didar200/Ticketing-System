@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Create New User</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="first_name">First Name<span class="text-danger">*</span></label>
                        <input id="first_name" type="text" class="form-control" name="first_name">
                        @error('first_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="last_name">Last Name<span class="text-danger">*</span></label>
                        <input id="last_name" type="text" class="form-control" name="last_name">
                        @error('last_name')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control" name="email">
                        @error('email')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input id="phone" type="text" class="form-control" name="phone">
                        @error('phone')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      
                    </div>

                  <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="password" class="d-block">Password<span class="text-danger">*</span></label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                        @error('password')
                        <div class="text-danger">* {{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      <label for="password_confirmation" class="d-block">Confirm Password<span class="text-danger">*</span></label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="form-group col-md-6 col-sm-12">
                      <label>Role<span class="text-danger">*</span></label>
                      <select class="custom-select" name="role">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                      </select>
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                      <label>Status<span class="text-danger">*</span></label>
                      <select class="custom-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>

                  </div>

                  <div class="row">
                    <div class="fallback form-group col-md-6 col-sm-12">
                        <label for='photo'>Photo</label>
                        <input name="photo" type="file" multiple class="form-control" />
                    </div>

                    <div class="fallback form-group col-md-6 col-sm-12">
                      <label for="">Select Group<span class="text-danger">*</span></label><br>
                      @foreach($groups as $group)
                        <div class="pretty p-default">
                          <input type="checkbox" name="groups[]" value="{{ $group->id }}" />
                          <div class="state p-primary">
                            <label>{{ $group->group_name }}</label>
                          </div>
                        </div>
                      @endforeach  
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
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