@extends('layout.master')

@section('content')

<div class="main-content">
  <section class="section">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h4>Email To Clients</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('customerEmail') }}" enctype="multipart/form-data">
                    @csrf

                    @if(Session::has('email_send'))
                      <div class="alert alert-success">{{ Session::get('email_send') }}</div>
                    @endif
                    

                    <div class="row">
                      <div class="form-group col-12">
                        <label for="subject">Subject<span class="text-danger">*</span></label>
                        <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                        @error('subject')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                                   
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="body">Body<span class="text-danger">*</span></label>
                        
                        <textarea class="summernote-simple" name="body">{{ old('body') }}</textarea>
                        
                        @error('body')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="fallback form-group col-md-6 col-sm-12">
                        <label for="attachment">Attachment:</label>
                        <input name="attachment" type="file" class="form-control" id="attachment" />
                        (<b>jpg, png, gif, txt and pdf</b> files are allowed) Max: 5MB

                        @error('attachment')
                          <div class="text-danger">* {{ $message }}</div>
                        @enderror
                        
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <div for="status">Select Client Category: <span class="text-danger">*</span></div>
                        <div class="pretty p-switch">
                          <input type="radio" name="status" value="2" />
                          <div class="state p-success">
                            <label>All</label>
                          </div>
                        </div>

                        <div class="pretty p-switch p-fill">
                          <input type="radio" name="status" checked value="1" />
                          <div class="state p-success">
                            <label>Active</label>
                          </div>
                        </div>

                        <div class="pretty p-switch p-fill">
                          <input type="radio" name="status" value="0" />
                          <div class="state p-success">
                            <label>Inactive</label>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="row">

                      <div class="form-group col-md-6 col-sm-12">
                        <label>POP:<span class="text-danger">*</span></label>
                        <select class="custom-select" name="pop" id="pop-customer">
                          <option value="0">All</option>
                          @foreach($pops as $pop)
                            <option value="{{ $pop->id }}">{{ $pop->pop_name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                        <label><b>Client:</b><span class="text-danger">*</span></label>
                        <select class="custom-select" id="customer-pop" name="customer">
                          <option value="0">All</option>
                        </select>
                      </div>
                      
                    </div>  

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Send
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
      $('#pop-customer').on('change', function () {
          var id = this.value;
          $("#customer-pop").html('');
          $.ajax({
              url: "{{ route('getCustomerByPop') }}",
              type: "POST",
              data: {
                  id: id,
                  _token: '{{csrf_token()}}'
              },
              dataType: 'json',
              success: function (data) {
                  $('#customer-pop').html(data.html);
              }
          });
      });
      
  });

</script>
@endpush