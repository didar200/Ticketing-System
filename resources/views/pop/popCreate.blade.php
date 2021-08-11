@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Add New POP</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('pop.create') }}">
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="pop_name">POP Name<span class="text-danger">*</span></label>
                        <input id="pop_name" type="text" class="form-control" name="pop_name">
                        @error('pop_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-12">
                          <label for="address">Address<span class="text-danger">*</span></label>
                          <textarea class="form-control" name="address" rows="8"></textarea>
                        @error('address')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">
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