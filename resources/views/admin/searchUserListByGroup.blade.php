@if($group)
  @foreach($group->users as $user)
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
@elseif($users)
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
@endif