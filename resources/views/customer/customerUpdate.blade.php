@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Update Customer</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('customer.updateProcess') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">

                      <input type="hidden" name="id" value="{{ $customer->id }}">

                      <div class="form-group col-6">
                        <label for="customer_id">Customer ID<span class="text-danger">*</span></label>
                        <input id="customer_id" type="text" class="form-control" name="customer_id" value="{{ $customer->customer_id }}">
                        @error('customer_id')
                            <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-6">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $customer->name }}">
                        @error('name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      
                    </div>

                    <div class="row">
                      <div class="form-group col-6">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $customer->email }}">
                        @error('email')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-6">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                        @error('phone')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                  
                      
                    </div>

                
                    <div class="row">
                      
                      <div class="form-group col-6">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" rows="8">{{ $customer->address }}</textarea>
                        @error('address')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-6">
                        <label>Status<span class="text-danger">*</span></label>
                        <select class="custom-select" name="status">
                          <option value="1" @if($customer->status == 1) selected @endif>Active</option>
                          <option value="0" @if($customer->status == 0) selected @endif>Inactive</option>
                        </select>
                      </div>

                    </div>

                    <div class="row">
                      <div class="form-group col-6">
                        <label>POP<span class="text-danger">*</span></label>
                        <select class="custom-select" id="group-users" name="pop">
                          @foreach($pops as $pop)
                            <option value="{{ $pop->id }}" @if($customer->pop->id == $pop->id) selected @endif>{{ $pop->pop_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    
                  

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