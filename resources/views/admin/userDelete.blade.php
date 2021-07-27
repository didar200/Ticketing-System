@extends('layout.master')

@section('content')

	<div class="container" style="margin-top: 150px;">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
              <div class="card-header">
                
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('user.DeleteProcess') }}">
                  @csrf

                  @method('DELETE')

                  <input type="hidden" name="id" value="{{ $user->id }}">
                  <div class="row">
                  	<div class="form-group col-md-12">
                    	<h4>Do you want to delete {{ $user->email }}</h4>

	               </div>
                  </div>
                  
	                  <div class="row">
	                  	<div class="col-md-4">
		                   
	                  	</div>
	                  	<div class="form-group col-md-2">
		                    <a href="{{ route('user.list') }}" class="btn btn-primary btn-lg">
		                      Cancel
		                    </a>
	                  	</div>

		                  <div class="form-group col-md-5 ml-2">
		                    <button type="submit" class="btn btn-danger btn-lg">
		                      Confirm Delete
		                    </button>
		                  </div>
                  	</div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection