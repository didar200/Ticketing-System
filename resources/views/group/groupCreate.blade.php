@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Create New Group</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('group.create') }}" enctype="multipart/form-data">
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="group_name">Group Name<span class="text-danger">*</span></label>
                        <input id="group_name" type="text" class="form-control" name="group_name">
                        @error('group_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Create
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