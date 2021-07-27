
@if($customers)
  @foreach($customers as $customer)
    <tr class="row-link">
      <td>{{ $customer['customer_id'] }} </td>
      <td>{{ $customer['name'] }}</td>
      <td>{{ $customer['phone'] }}</td>
      <td>{{ $customer['pop']['pop_name'] }}</td>
      
      @if($customer['status'] == 1)
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
          <a href="{{ route('customer.update', ['id' => $customer['id']]) }}"><i class="fas fa-edit" title="Edit"></i></a>
        @endif
        <input type="submit" value="Details" onclick="detailCustomer({{ $customer['id'] }})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="detailsBtn">
      </td> 

    </tr>
  @endforeach  
@endif
