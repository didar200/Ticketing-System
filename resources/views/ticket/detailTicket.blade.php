@extends('layout.master')

@section('content')

<style>

  .row-link{
    cursor: pointer;
  }

  tr{background-color: #E6E6FA;}
  /*tr:nth-child(even) {background-color: #F0FFF0;}
  tr:nth-child(odd) {background-color: #E6E6FA;}*/

  .row-link:hover{
    background: #B0E0E6;
  }

</style>


<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary" style="border-style:solid;border-width: 1px 1px 1px 1px;">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <label>
                  <b>TT #: </b>{{ $ticket->id}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Customer Name: </b>{{ $ticket->customer->customer_id}} ({{ $ticket->customer->name }}). &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Created By:</b> {{ $ticket->created_user }}. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Created Date:</b> {{ date_format($ticket->created_at, 'd M Y, h:i A') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Status:</b> {{ $ticket->status }}.
                </label>
                <br><br>
              </div>
            </div>

            <div class="row">
              <div class="col-6" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 10px;">
               
                  <table class="table table-bordered table-sm table-light">
                    <tr>
                      <td class="row-link">
                        <b>Subject: </b>
                        <br>
                        <p>
                          {!! $ticket->title !!}
                        </p>
                      </td>
                    </tr>

                    <tr>
                      <td class="row-link">
                        <br>
                        <b>Body: </b>
                        <p>
                          {!! $ticket->description !!}
                        </p>

                        <p>
                          @if($ticket->attachment != null)
                            <b>Attachment:</b>
                            @foreach(json_decode($ticket->attachment, true) as $attachment)
                              <a href="/assets/attachment/{{ $attachment }}" target="_blank">{{ $attachment }}</a>,&nbsp;
                            @endforeach
                          @endif
                        </p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <form method="POST" action="{{ route('addNoteProcess') }}" enctype="multipart/form-data">
                          @csrf

                          <input id="user_id" type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                          <input id="ticket_id" type="hidden" name="ticket_id" value="{{ $ticket->id}}">

                          <div class="form-group">
                            <label for="attachment"><b>Note:<span class="text-danger">*</span></b></label>
                            <textarea class="summernote-simple" name="notes">{{ old('notes') }}</textarea>
                            @error('notes')
                              <div class="text-danger">* {{ $message }}</div>
                            @enderror
                          </div>
                          
                          <div class="fallback form-group">
                            <label for="attachment"><b>Attachment:</b></label>
                            <input name="attachment[]" type="file" multiple class="form-control"/>
                            (jpg, png, gif, txt and pdf files are allowed) Max: 2MB
                          </div>
                          @if (count($errors) > 0)
                            <div class="text-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif                       
                          
                          <div class="form-group"> 
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                              Save
                            </button>
                          </div>
                          
                        </form>
                      </td>
                    </tr>
                  
                  </table>

              </div> 

              <div class="col-6" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 10px;">
                <form method="POST" action="{{ route('ticketUpdate') }}">
                  @csrf 

                  <table class="table table-bordered table-sm table-light">
                    <tr>
                      <td>
                        <div class="row">
                          <div class="form-group col-12">
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <p>&nbsp;&nbsp;</p>        
                          </div>
                                          
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Status<span class="text-danger">*</span></label>
                            @if($member == 1)
                              <select class="custom-select" id="" name="status">
                                @foreach($status as $stat)
                                  <option value="{{ $stat }}"  @if($ticket->status == $stat) selected @endif>{{ $stat }}</option>
                                @endforeach
                              </select>
                            @else
                              <select class="custom-select" id="" name="status" disabled>
                                @foreach($status as $stat)
                                  <option value="{{ $stat }}"  @if($ticket->status == $stat) selected @endif>{{ $stat }}</option>
                                @endforeach
                              </select>
                            @endif
                          </div>    
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Select Group<span class="text-danger">*</span></label>
                            @if($member == 1)
                              <select class="custom-select" id="group-users" name="group_id">
                                <option value="">Select...</option>
                                @foreach($groups as $group)
                                  <option value="{{ $group->id }}" @if($ticket->group->id == $group->id) selected @endif>{{ $group->group_name }}</option>
                                @endforeach
                              </select>
                            @else
                              <select class="custom-select" id="group-users" name="group_id" disabled>
                                <option value="">Select...</option>
                                @foreach($groups as $group)
                                  <option value="{{ $group->id }}" @if($ticket->group->id == $group->id) selected @endif>{{ $group->group_name }}</option>
                                @endforeach
                              </select>
                            @endif  
                          </div>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="row">  
                          <div class="form-group col-12">
                            <label>Assign to<span class="text-danger">*</span></label>
                            @if($member == 1)
                              <select class="custom-select" id="users-group" name="user_id">
                                @foreach($groups as $group)
                                  @if($ticket->group->id == $group->id){
                                    @foreach($group->users as $user)
                                      <option value="{{ $user->id }}" @if($ticket->user->id == $user->id) selected @endif> {{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                  @endif
                                @endforeach  
                              </select>
                            @else
                              <select class="custom-select" id="users-group" name="user_id" disabled>
                                @foreach($groups as $group)
                                  @if($ticket->group->id == $group->id){
                                    @foreach($group->users as $user)
                                      <option value="{{ $user->id }}" @if($ticket->user->id == $user->id) selected @endif> {{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                  @endif
                                @endforeach  
                              </select>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="row">
                          <div class="form-group col mt-3">
                            @if($member == 1)
                              <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                              </button>
                            @else
                              <button type="submit" class="btn btn-primary btn-lg btn-block" disabled>
                                Save
                              </button>
                            @endif
                          </div> 
                        </div>
                      </td>
                    </tr>
                  </table>                 
                </form>
              </div>   
            </div>

            <div class="row">
              <div class="form-group col-6" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 10px;">
                <div>
                  <b>Notes: </b>
                </div>
                <hr>
                
                <table class="table table-bordered table-sm table-light">
                  @foreach($notes as $note)
                    <tr style="border-style:solid;border-width: 0px 0px 5px 0px; border-color: #E8F8F5;border-radius: 10px;">
                      <td class="row-link">
                        {!! $note->notes !!} <br>


                        @if($note->attachment != null)
                          Attachment:
                          @foreach(json_decode($note->attachment, true) as $attachment)
                           <a href="/assets/attachment/{{ $attachment }}" target="_blank">{{ $attachment }}</a>,&nbsp;
                          @endforeach
                        @endif

                        <br>  
                    
                        <b>Noted By: </b>{{ $note->user->first_name }} {{ $note->user->last_name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Date:
                        {{ date_format($note->created_at, 'd M Y, h:i A') }}
                        
                        </b>({{ $note->created_at->diffForHumans() }})

                      </td> 
                    </tr>
                  @endforeach
                </table>  

              </div>

              <div class="form-group col-6" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 10px;">
                <div>
                  <b>History: </b>
                </div>
                <hr>
                
                <table class="table table-bordered table-sm table-light">
                @foreach($histories as $history)
                  <tr style="border-style:solid;border-width: 0px 0px 5px 0px; border-color: #E8F8F5;border-radius: 10px;">
                    <td class="row-link">
                      {{ $history->history}} at {{ date_format($history->created_at, 'd M Y, h:i A') }}
                    </td>
                  </tr>
                @endforeach
                </table> 

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
    $('#group-users').on('change', function () {
      var id = this.value;
      $("#users-group").html('');
      $.ajax({
          url: "{{ route('getUserByGroupID') }}",
          type: "POST",
          data: {
              id: id,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (data) {
              $('#users-group').html(data.html);
          }
      });
    });

  });

</script>
@endpush