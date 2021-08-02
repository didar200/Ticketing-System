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
                  <a class="nav-link active" href="{{ route('myTicket.list') }}">My Tickets <span class="badge badge-white">{{ $myCount }}</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('groupTicket.list') }}">Group Tickets <span class="badge badge-primary">{{ $gCount }}</span></a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Client</th>
                      <th>Group</th>
                      <th>Assign To</th>
                      <th>Status</th>
                      <th>Subject</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tickets as $ticket)
                      <tr onclick="window.location='{{ route('detailTicket', $ticket->id) }}';" class="row-link">
                        <td>{{ $ticket->id }} </td>
                        <td>{{ $ticket->customer->name }}</td>
                        <td>{{ $ticket->group->group_name }}</td>
                        <td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                        <td>
                          <div class="badge badge-warning badge-shadow">{{ $ticket->status }} </div>
                        </td>
                        <td>{{ $ticket->title }}</td>  
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $tickets->links('layout.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

