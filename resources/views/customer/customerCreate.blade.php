@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Add New Client</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('customer.create') }}">
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">

                      <div class="form-group col-md-6 col-sm-12">
                        <label for="customer_id">Client ID<span class="text-danger">*</span></label>
                        <input id="customer_id" type="text" class="form-control" name="customer_id">
                        @error('customer_id')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" name="name">
                        @error('name')
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
                          <label for="address">Address</label>
                          <textarea class="form-control" name="address" rows="8"></textarea>
                        @error('address')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
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

                      <div class="form-group col-md-6 col-sm-12">
                        <label>POP<span class="text-danger">*</span></label>
                        <select class="custom-select" name="pop">
                          @foreach($pops as $pop)
                            <option value="{{ $pop->id }}">{{ $pop->pop_name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <label>Sales Person(Member of Marketing Group)<span class="text-danger">*</span></label>
                        <select class="custom-select" name="user">
                          @if($groups)
                            @foreach($groups->users as $user)
                              <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>

                    </div>

                    
                  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Add
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