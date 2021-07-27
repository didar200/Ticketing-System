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

              <h4>POP List</h4>

              @if(auth()->user()->role == 1)
                <div style="margin-left: auto;">
                  <a class="btn btn-primary" href="{{ route('pop.create') }}">Add POP</a>
                </div>
              @endif
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  <thead>
                    <tr>
                      <th>POP Name</th>
                      <th>Address</th>
                      <th>Status</th>
                      @if(auth()->user()->role == 1)
                        <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pops as $pop)
                      <tr class="row-link">
                        <td>{{ $pop->pop_name }}</td>
                        <td>{{ $pop->address }}</td>
                        
                        @if($pop->status == 1)
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                        @else
                          <td>
                            <div class="badge badge-danger">Inactive</div>
                          </td>
                        @endif

                        @if(auth()->user()->role == 1)
                          <td>
                            <a href="{{ route('pop.update', ['id' => $pop->id]) }}"><i class="fas fa-edit" title="Edit"></i></a>
                          </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $pops->links('layout.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection