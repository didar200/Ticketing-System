@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                Update POP
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('pop.updateProcess') }}">
                    @csrf

                    @method('PUT')

                    <div class="row">
                      <input type="hidden" name="id" value="{{ $pop->id }}">
                      <div class="form-group col-12">
                        <label for="pop_name">POP Name<span class="text-danger">*</span></label>
                        <input id="pop_name" type="text" class="form-control" name="pop_name" value="{{ $pop->pop_name }}">
                        @error('pop_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="row">
                       <div class="form-group col-12">
                          <label for="address">Address<span class="text-danger">*</span></label>
                          <textarea class="form-control" name="address" rows="8">{{ $pop->address }}</textarea>
                        @error('address')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-12">
                        <label>Status<span class="text-danger">*</span></label>
                        <select class="custom-select" name="status">
                          <option value="1" @if($pop->status == 1) selected @endif>Active</option>
                          <option value="0" @if($pop->status == 0) selected @endif>Inactive</option>
                        </select>
                      </div>
                    </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">
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