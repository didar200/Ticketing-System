@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                Group Update
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('group.updateProcess') }}">
                    @csrf

                    @method('PUT')

                    <div class="row">

                      <input type="hidden" name="id" value="{{ $group->id }}">

                      <div class="form-group col-12">
                        <label for="group_name">Group Name<span class="text-danger">*</span></label>
                        <input id="group_name" type="text" class="form-control" name="group_name" value="{{ $group->group_name }}">
                        @error('group_name')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-12">
                        <label>Status<span class="text-danger">*</span></label>
                        <select class="custom-select" name="status">
                          <option value="1" @if($group->status == 1) selected @endif>Active</option>
                          <option value="0" @if($group->status == 0) selected @endif>Inactive</option>
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