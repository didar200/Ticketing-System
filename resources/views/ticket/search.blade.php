@extends('layout.master')

@section('content')
<style>
  .row-link{
    cursor: pointer;
  }

  tr:nth-child(even) {background-color: #F0FFF0;}
  tr:nth-child(odd) {background-color: #E6E6FA;}

  .row-link:hover{
    background: LightCyan;
  }

</style>

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">

          <div class="card">
        
            <div class="card-header col-md-6 col-sm-12">
              <div class="col-6">
                <input class="form-control" type="search" name="search" placeholder="Ticket No." aria-label="Search" data-width="180" id="search" onkeyup="ticketList()" data-url="{{ URL::to('searchTicketAjax') }}">
              </div> 
            
              <div class="col-6">
                <input class="form-control" type="search" name="searchCustomer" placeholder="Customer ID." aria-label="Search" data-width="180" id="searchCustomer" onkeyup="customerTicketList()" data-url="{{ URL::to('searchCustomerTicketAjax') }}">
              </div> 
            </div>

            <h4 class="mt-3 ml-4">Search Result:</h4>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" >
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Group</th>
                        <th>Assign To</th>
                        <th>Status</th>
                        <th>Subject</th>
                      </tr>
                    </thead>
                    <tbody id="tableData">
                      
                    </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
