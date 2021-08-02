<form>
                    
  <div class="row">

    <div class="form-group col-6">
      <label for="customer_id"><b>Client ID: </b>{{ $customer->customer_id }}</label>
    </div>

    <div class="form-group col-6">
      <label for="name"><b>Client Name: </b>{{ $customer->name }}</label>
    </div>  
    
  </div>

  <div class="row">
    <div class="form-group col-6">
      <label for="email"><b>Email: </b>{{ $customer->email }}</label>
    </div>

    <div class="form-group col-6">
      <label for="phone"><b>Phone: </b>{{ $customer->phone }}</label>
    </div>         
    
  </div>


  <div class="row">
    <div class="form-group col-6">
        <label for="address"><b>Address: </b>{{ $customer->address }}</label>
    </div>

    <div class="form-group col-6">
      <label><b>Status: </b></label>
      @if($customer->status == 1)
        <span class="badge badge-success">Active</span>
      @else
        <span class="badge badge-danger">Inactive</span>
      @endif
      
    </div>
  </div>

  <div class="row">
    <div class="form-group col-6">
      <label for="pop"><b>POP: </b>{{ $customer->pop->pop_name }}</label>
    </div>
  </div>

</form>