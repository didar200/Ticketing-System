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

              <h4>Group List</h4>

              <div style="margin-left: auto;">
                <a class="btn btn-primary btn-sm" href="{{ route('group.create') }}">Add Group</a>
              </div>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  <thead>
                    <tr>
                      <th>Group Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($groups as $group)
                      <tr class="row-link">
                        <td>{{ $group->group_name }}</td>
                        
                        @if($group->status == 1)
                          <td>
                            <div class="badge badge-success">Active</div>
                          </td>
                        @else
                          <td>
                            <div class="badge badge-danger">Inactive</div>
                          </td>
                        @endif
                        <td>
                          <a href="{{ route('group.update', ['id' => $group->id]) }}"><i class="fas fa-edit" title="Edit"></i></a>
                          <!-- <a href="#"><i class="fas fa-trash-alt" title="Delete"></i></a> -->
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $groups->links('layout.pagination') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection