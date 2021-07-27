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
            <h4 class="mt-3 ml-4">Search Result:</h4>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  @if($message)
                      <b>{{ $message }}</b>                      
                  @else  
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Group</th>
                        <th>Assign To</th>
                        <th>Status</th>
                        <th>Subject</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($tickets)
                        @foreach($tickets as $ticket)
                          <tr onclick="window.location='{{ route('detailTicket', ['tt' => $ticket->id]) }}';" class="row-link">
                            <td>{{ $ticket->id }} </td>
                            <td>{{ $ticket->customer->name }} ({{ $ticket->customer->customer_id }})</td>
                            <td>{{ $ticket->group->group_name }}</td>
                            <td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                            <td>
                              <div @if($ticket->status == "Open" || $ticket->status == "Reopen") class="badge badge-danger badge-shadow" @endif @if($ticket->status == "Pending") class="badge badge-warning badge-shadow" @endif @if($ticket->status == "Closed") class="badge badge-success badge-shadow" @endif>{{ $ticket->status }} </div>
                            </td>
                            <td>{{ $ticket->title }}</td>  
                          </tr>
                          @endforeach
                        @endif
                     
                    </tbody>
                    @endif
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