@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                Update
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('user.UpdateProcess') }}" enctype="multipart/form-data">
                    @csrf

                    @method('PUT')

                    <div class="row">

                      <input type="hidden" name="id" value="{{ $user->id }}">

                      <div class="form-group col-6">
                        <label for="first_name">First Name<span class="text-danger">*</span></label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                        @error('first_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      <div class="form-group col-6">
                        <label for="last_name">Last Name<span class="text-danger">*</span></label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                        @error('last_name')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-6">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control" readonly name="email" value="{{ $user->email }}">
                        @error('email')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-6">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        @error('phone')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      
                    </div>

                  {{--<div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password<span class="text-danger">*</span></label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                        @error('password')
                        <div class="text-danger">* {{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">Confirm Password<span class="text-danger">*</span></label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                    </div>
                  </div>--}}

                  <div class="row">
                    
                    <div class="form-group col-6">
                      <label>Role<span class="text-danger">*</span></label>
                      <select class="custom-select" name="role">
                        <option value="0" @if($user->role == 0) selected @endif>User</option>
                        <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                      </select>
                    </div>

                    <div class="form-group col-6">
                      <label>Status<span class="text-danger">*</span></label>
                      <select class="custom-select" name="status">
                        <option value="1" @if($user->status == 1) selected @endif>Active</option>
                        <option value="0" @if($user->status == 0) selected @endif>Inactive</option>
                      </select>
                    </div>

                  </div>

                  <div class="row">
                    
                    @php
                      $usergroup_ids = array();
                      foreach($user->groups as $group)
                      {
                        if($group->status == 1)
                        {
                          array_push($usergroup_ids,  $group->id);
                        }
                        
                      }
                    @endphp

                    

                    <div class="fallback form-group col-6">

                      <label for="">Select Group<span class="text-danger">*</span></label><br>
                      @foreach($groups as $group)
                        <div class="pretty p-default">
                          <input type="checkbox" name="groups[]" @if(in_array($group->id, $usergroup_ids)) checked @endif value="{{ $group->id }}" />
                          <div class="state p-primary">
                            <label>{{ $group->group_name }}</label>
                          </div>
                           
                        </div>
                      @endforeach  
                    </div>
                  </div>

                  {{--<div class="row">
                    <div class="fallback form-group col-6">
                        <label for='photo'>Photo</label>
                        <input name="photo" type="file" multiple class="form-control" />
                    </div>
                  </div>--}}

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Update
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