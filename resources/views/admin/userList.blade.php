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
              <h4>User List</h4>
              <div style="margin-left: auto;">
                <select class="custom-select form-control" data-width="180" data-height="40" name="group_name" id="group_name">
                  <option value="0">Select...Group</option>
                  @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                  @endforeach
                </select>
              </div>
              <div style="margin-left: auto;">
                <a class="btn btn-primary btn-sm" href="{{ route('user.register') }}">Add User</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm table-light" id="table-1">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Groups</th>
                      <th>Status</th>
                      <th>Role</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableData">
                    @foreach($users as $user)
                      <tr class="row-link">
                        
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @foreach($user->groups as $group)
                            {{ $group->group_name }} <span class="text-danger"><b>|</b></span>
                          @endforeach
                        </td>
                        
                        @if($user->status == 1)
                          <td>
                            <div class="badge badge-success">Active</div>
                        </td>
                        @else
                          <td>
                            <div class="badge badge-danger">Inactive</div>
                        </td>
                        @endif

                        @if($user->role == 1)
                          <td>
                            <div class="badge badge-warning">Admin</div>
                          </td> 
                        @else
                          <td>
                            <div class="badge badge-info">User</div>
                          </td>
                        @endif

                        <td>
                          <img alt="image" class="user-img-radious-style" style="width: 30px; height: 30px;" src="{{ $user->photo }}" >
                        </td>
                        
                        <td>
                          <a href="{{ route('user.update', ['id' => $user->id]) }}"><i class="fas fa-edit" title="Edit"></i></a>
                        </td>
                        
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $users->links('layout.pagination') }}
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
      $('#group_name').on('change', function () {

          let search = $('#group_name').val();

          $.ajax({
              url: "searchUserListByGroup?search="+search,
              type: "GET",
              data: {
                  search: search,
              },
              dataType: "JSON",
              success: function(response){
                  let list = JSON.parse(response.data);
                  $("#tableData").html(list);
              },
              error: function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR, textStatus, errorThrown);
              }
          });
      });
      
  });

</script>
@endpush