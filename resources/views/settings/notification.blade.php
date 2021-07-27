@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Notifications</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('emailNotification') }}">
                    @csrf

                    @if(Session::has('save'))
                      <div class="alert alert-success">{{ Session::get('save') }}</div>
                    @endif
                    
                    <div class="row">
                      
                      <div class="fallback form-group col-md-6 col-sm-12">
                        <input type="checkbox" id="email" name="email" @if($notify->notification_status == 1) checked @endif >
                        <label for="email" style="font-size: 16px;">  Email</label>  
                      </div>

                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Save
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