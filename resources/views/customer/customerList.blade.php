@extends('layout.master')

@section('content')

<style>

  .row-link{
    cursor: pointer;
  }

  tr:nth-child(even) {background-color: #F0FFF0;}
  tr:nth-child(odd) {background-color: #E6E6FA;}

  .row-link:hover{
    background: #B0E0E6;
  }

</style>  

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              
              <div><h4>Client List:</h4></div>

              <div style="margin-left: auto;">
                <input class="form-control" type="search" name="search" placeholder="Client ID." aria-label="Search" data-width="180" data-height="40" id="search" onkeyup="searchCustomerList()" data-url="{{ URL::to('searchCustomerList') }}">
              </div>

              <div style="margin-left: auto;">
                <select class="custom-select form-control" data-width="180" data-height="40" name="pop" id="pop">
                  <option value="0">Select...POP</option>
                  @foreach($pops as $pop)
                    <option value="{{ $pop->id }}">{{ $pop->pop_name }}</option>
                  @endforeach
                </select>
              </div>

              @if(auth()->user()->role == 1)
                <div style="margin-left: auto;">
                  <a class="btn btn-primary btn-sm" href="{{ route('customer.create') }}">Add Client</a>
                </div>
              @endif
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  <thead>
                    <tr>
                      <th>Client#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>POP</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableData">
                    @foreach($customers as $customer)
                      <tr class="row-link">
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->pop->pop_name }}</td>
                        @if($customer->status == 1)
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                        @else
                          <td>
                            <div class="badge badge-danger">Inactive</div>
                          </td>
                        @endif
                        
                      
                        <td>
                          @if(auth()->user()->role == 1)
                            <a href="{{ route('customer.update', ['id' => $customer->id]) }}"><i class="fas fa-edit" title="Edit"></i></a>
                          @endif
                          <input type="submit" value="Details" onclick="detailCustomer({{ $customer->id }})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="detailsBtn">
                        </td>                         
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $customers->links('layout.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel"><b>Client Details: </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="detailCustomers">
          
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')

<script>
  $(document).ready(function () {
      $('#pop').on('change', function () {

          let search = $('#pop').val();

          $.ajax({
              url: "searchCustomerListPop?search="+search,
              type: "GET",
              data: {
                  search: search,
              },
              dataType: "JSON",
              success: function(response){
                  let list = JSON.parse(response.data);
                  $("#tableData").html(list);
              },
              error: function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR, textStatus, errorThrown);
              }
          });
      });
      
  });

</script>
@endpush
