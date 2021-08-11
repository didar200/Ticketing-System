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

  #reload{
    cursor: pointer;
  }

  #reload:hover{
    background: LightCyan;
  }

</style>


<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
          <div class="card">
            <!-- <div class="card-header">
              <h4>Default Tab</h4>
            </div> -->
            <div class="card-body">
              

              <ul class="nav nav-tabs" id="myTab" role="tablist">

                <div style="margin-right: 10px; margin-top: 10px;">
                  <li class="nav-item">
                    <a id="reload"><i style="font-size:24px" class="fa">&#xf021;</i></i></a>
                  </li>
                </div>

                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">My Tickets ( {{ $myCount }} )</a>
                </li>
              
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Group Tickets ( {{ $gCount }} )</a>
                </li>
                
                <div style="margin-left: auto;">
                  <li class="nav-item">
                    <a class="btn btn-primary btn-sm" href="{{ route('ticket.create') }}">Create New</a>
                  </li>
                </div>
                
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm table-light" id="table-10">
                      <thead>
                        <tr>
                          <th>TT#</th>
                          <th>Client</th>
                          <th>Group</th>
                          <th>Assign To</th>
                          <th>Status</th>
                          <th>Subject</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mytickets as $ticket)
                          <tr onclick="window.location='{{ route('detailTicket', ['tt' => $ticket->id]) }}';" class="row-link">
                            <td>{{ $ticket->id }} </td>
                            <td>{{ $ticket->customer->name }} ({{ $ticket->customer->customer_id }})</td>
                            <td>{{ $ticket->group->group_name }}</td>
                            <td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                            <td>
                              <div @if($ticket->status == "Open" || $ticket->status == "Reopen") class="badge badge-danger badge-shadow" @endif @if($ticket->status == "Pending") class="badge badge-warning badge-shadow" @endif >{{ $ticket->status }} </div>
                            </td>
                            <td>{{ $ticket->title }}</td>  
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>  
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm table-light" id="table-1">
                      <thead>
                        <tr>
                          <th>TT#</th>
                          <th>Client</th>
                          <th>Group</th>
                          <th>Assign To</th>
                          <th>Status</th>
                          <th>Subject</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($gtickets as $ticket)
                          @foreach($ticket as $data)
                            <tr onclick="window.location='{{ route('detailTicket', ['tt' => $data['id']]) }}';" class="row-link">
                              <td>{{ $data['id'] }}</td>
                              <td>{{ $data['customer']['name'] }} ({{ $data['customer']['customer_id'] }})</td>
                              <td>{{ $data['group']['group_name'] }}</td>
                              <td>{{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }}</td>
                              <td>
                                <div @if($data['status'] == "Open" || $data['status'] == "Reopen") class="badge badge-danger badge-shadow" @endif @if($data['status'] == "Pending") class="badge badge-warning badge-shadow" @endif >{{ $data['status'] }} </div>
                              </td>
                              <td>{{ $data['title'] }}</td>  
                            </tr>
                          @endforeach
                        @endforeach
                      </tbody>
                    </table>
                   
                  </div>
                </div>
              </div>
            </div>
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
    
    $('#reload').click(function() {
    location.reload();
    });

  });

</script>
@endpush