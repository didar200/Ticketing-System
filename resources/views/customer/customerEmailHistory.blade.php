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
              
              <div><h4>Email History:</h4></div>
              
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject</th>
                      <th>POP</th>
                      <th>Client</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableData">
                    @foreach($emailHistories as $history)
                      <tr class="row-link">
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->subject }}</td>
                        <td>{{ $history->pop }}</td>
                        <td>{{ $history->customer }}</td>
                        <td>{{ $history->category }}</td>
                        <td>{{ date_format($history->created_at, 'd M Y, h:i A') }}</td>
                        <td>
                          <input type="submit" value="Details" onclick="detailCustomerEmail({{ $history->id }})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="detailsBtn">
                        </td>                         
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $emailHistories->links('layout.pagination') }}
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
        <h5 class="modal-title" id="myLargeModalLabel"><b>Email Details: </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="detailCustomerEmail">
          
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
