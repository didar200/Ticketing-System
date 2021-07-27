
@if($tickets)
  @foreach($tickets as $ticket)
    <tr onclick="window.location='{{ route('detailTicket', ['tt' => $ticket['id']]) }}';" class="row-link">
      <td>{{ $ticket['id'] }} </td>
      <td>{{ $ticket['customer']['name'] }} ({{ $ticket['customer']['customer_id'] }})</td>
      <td>{{ $ticket['group']['group_name'] }}</td>
      <td>{{ $ticket['user']['first_name'] }} {{ $ticket['user']['last_name'] }}</td>
      <td>
        <div @if($ticket['status'] == "Open" || $ticket['status'] == "Reopen") class="badge badge-danger badge-shadow" @endif @if($ticket['status'] == "Pending") class="badge badge-warning badge-shadow" @endif @if($ticket['status'] == "Closed") class="badge badge-success badge-shadow" @endif>{{ $ticket['status'] }} </div>
      </td>
      <td>{{ $ticket['title'] }}</td>  
    </tr>
  @endforeach  
@endif
                     
