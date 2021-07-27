@extends('layout.master')

@section('content')

  <style>
  .row-link{
    cursor: pointer;
  }

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
            <div class="card-header">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('myTicket.list') }}">My Tickets <span class="badge badge-primary">{{ $myCount }}</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{ route('groupTicket.list') }}">Group Tickets <span class="badge badge-white">{{ $gCount }}</span></a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
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
                    @foreach($tickets as $ticket)
                      @foreach($ticket as $data)
                        <tr onclick="window.location='{{ route('detailTicket', $data['id']) }}';" class="row-link">
                          <td>{{ $data['id'] }}</td>
                          <td>{{ $data['customer']['name'] }}</td>
                          <td>{{ $data['group']['group_name'] }}</td>
                          <td>{{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }}</td>
                          <td>
                            <div class="badge badge-warning badge-shadow">{{ $data['status'] }} </div>
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
  </section>
</div>

	<!-- <div class="main-content">
        <section class="section">
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card mb-0">
                  <div class="card-body">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('myTicket.list') }}">My Tickets <span class="badge badge-primary">{{ $myCount }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="{{ route('groupTicket.list') }}">Group Tickets <span class="badge badge-white">{{ $gCount }}</span></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md">
                        <tr>
                          <th>ID</th>
                          <th>Customer</th>
                          <th>Group</th>
                          <th>Assign To</th>
                          <th>Status</th>
                          <th>Subject</th>
                        </tr>
                        @foreach($tickets as $ticket)
                          @foreach($ticket as $data)
                            <tr>
                              <td><a href="{{ route('detailTicket', $data['id']) }}">{{ $data['id'] }} </a></td>
                              <td>{{ $data['customer']['name'] }}</td>
                              <td>{{ $data['group']['group_name'] }}</td>
                              <td>{{ $data['user']['first_name'] }} {{ $data['user']['last_name'] }}</td>
                              <td>{{ $data['status'] }}</td>
                              <td>{{ $data['title'] }}</td>
                            </tr>
                          @endforeach 
                        @endforeach
                      </table>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
        </div>
    </section>
</div> -->

@endsection