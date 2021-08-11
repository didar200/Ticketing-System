@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>SMTP Information</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('smtpConfigure') }}">
                    @csrf

                    @if(Session::has('save'))
                      <div class="alert alert-success">{{ Session::get('save') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="host">SMTP Server<span class="text-danger">*</span></label>
                        <input id="host" type="text" class="form-control" name="host" value="{{ $smtp->host }}">
                        @error('host')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="port">Port<span class="text-danger">*</span></label>
                        <input id="port" type="text" class="form-control" name="port" value="{{ $smtp->port }}">
                        @error('port')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="username">Username<span class="text-danger">*</span></label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ $smtp->username }}">
                        @error('username')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input id="password" type="text" class="form-control" name="password" value="{{ $smtp->password }}">
                        @error('password')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                      
                      
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="address">From Address<span class="text-danger">*</span></label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ $smtp->address }}">
                        @error('address')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      <div class="form-group col-md-6 col-sm-12">
                        <label for="name">From Name<span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $smtp->name }}">
                        @error('name')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>
                    </div>

                    <div class="row">

                      <div class="form-group col-md-6 col-sm-12">
                        <div for="status">Encryption<span class="text-danger">*</span></div>
                        <div class="pretty p-switch">
                          <input type="radio" name="encryption" @if($smtp->encryption == null) checked @endif value="" />
                          <div class="state p-success">
                            <label>None</label>
                          </div>
                        </div>

                        <div class="pretty p-switch p-fill">
                          <input type="radio" name="encryption" @if($smtp->encryption == 'ssl') checked @endif value="ssl" />
                          <div class="state p-success">
                            <label>SSL</label>
                          </div>
                        </div>

                        <div class="pretty p-switch p-fill">
                          <input type="radio" name="encryption" @if($smtp->encryption == 'tls') checked @endif value="tls" />
                          <div class="state p-success">
                            <label>TLS</label>
                          </div>
                        </div>

                      </div>

                    </div>
                  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">
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