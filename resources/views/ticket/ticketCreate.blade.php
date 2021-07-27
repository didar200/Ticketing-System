@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Create New Ticket</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('ticket.create') }}" enctype="multipart/form-data">
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-6">
                        <label><b>Select Customer:</b><span class="text-danger">*</span></label>
                        <select class="custom-select" name="customer_id">
                          @foreach($customers as $customer)
                          <option value="{{ $customer->id }}">{{ $customer->customer_id}} ({{ $customer->name }})</option>
                          @endforeach

                        </select>
                      </div>

                      <div class="form-group col-6">
                        <label><b>Status:</b><span class="text-danger">*</span></label>
                        <select class="custom-select" id="" name="status">
                          <option value="Open">Open</option>
                          <option value="Reopen">Reopen</option>
                          <option value="Pending">Pending</option>
                          <option value="Closed">Closed</option>
                        </select>
                      </div>    
                    </div>

                    <div class="row">

                      <div class="form-group col-6">
                        <label><b>Select Group:</b><span class="text-danger">*</span></label>
                        <select class="custom-select" id="group-users" name="group_id">
                          <option value="">Select...</option>
                          @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                          @endforeach
                        </select>
                        @error('group_id')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group col-6">
                        <label><b>Assign to:</b><span class="text-danger">*</span></label>
                        <select class="custom-select" id="users-group" name="user_id">
                          
                        </select>
                        @error('user_id')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>

                    </div>

                    <div class="row">
                      <div class="form-group col-12">
                        <label for="title"><b>Subject:</b><span class="text-danger">*</span></label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                                   
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="title"><b>Description:</b><span class="text-danger">*</span></label>
                        <div>
                          <textarea class="summernote-simple" name="description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="fallback form-group col-6">
                        <label for="attachment"><b>Attachment:</b></label>
                        <input name="attachment[]" type="file" multiple class="form-control" id="attachment" />
                        (<b>jpg, png, gif, txt and pdf</b> files are allowed) Max: 2MB

                        @if (count($errors) > 0)
                          <div class="text-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </div>

                      <div class="fallback form-group col-6">
                        <input type="checkbox" id="email" name="email">
                        <label for="email" style="font-size: 16px;">  Email</label>  
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


@push('scripts')

<script>
  $(document).ready(function () {
      $('#group-users').on('change', function () {
          var id = this.value;
          $("#users-group").html('');
          $.ajax({
              url: "{{ route('getUserByGroupID') }}",
              type: "POST",
              data: {
                  id: id,
                  _token: '{{csrf_token()}}'
              },
              dataType: 'json',
              success: function (data) {
                  $('#users-group').html(data.html);
              }
          });
      });
      
  });

</script>
@endpush