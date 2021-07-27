<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
</head>
<body>

	<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header text-center">
                Create New Ticket
              </div>
              <div class="card-body">
                <form>
                    @csrf

                    @if(Session::has('create'))
                      <div class="alert alert-success">{{ Session::get('create') }}</div>
                    @endif
                    
                    <div class="row">
                      <div class="form-group col-12">
                        <label>Select Customer<span class="text-danger">*</span></label>
                        <select class="custom-select" name="customer_id">
                          @foreach($customers as $customer)
                          <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-12">
                        <label>Select Group<span class="text-danger">*</span></label>
                        <select class="custom-select" id="group-users" name="group_id">
                          <option value="">Select...</option>
                          @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-12">
                        <label>Assign to<span class="text-danger">*</span></label>
                        <select class="custom-select" id="users-group" name="user_id">
                          
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-12">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input id="title" type="text" class="form-control" name="title">
                        @error('title')
                            <div class="text-danger">* {{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                                   
                    <div class="row">
                      <div class="form-group col-12">
                        <div class="form-group">
                          <label for="description">Description<span class="text-danger">*</span></label>
                          <textarea class="form-control" name="description" rows="8"></textarea>
                        </div>
                        @error('description')
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

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	 
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
                    success: function (users) {
                        //$('#users-group').html('<option value="">Select State</option>');
                        $.each(users, function (key, value) {
                            $("#users-group").append('<option value="' + value.id + '">' + value.first_name + ' ' + value.last_name + '</option>');
                        });
                        // $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            
        });

    </script>

</body>
</html>