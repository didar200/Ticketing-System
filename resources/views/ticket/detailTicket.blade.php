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

  .lock-unlock{
    display: none;
  }

  #file_delete{
    /*display: none;*/
  }


</style>


<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <label>
                  <b>TT #: </b>{{ $ticket->id }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Client Name: </b>{{ $ticket->customer->customer_id}} ({{ $ticket->customer->name }}). &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Created By:</b> {{ $ticket->created_user }}. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Created Date:</b> {{ date_format($ticket->created_at, 'd M Y, h:i A') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>Status:</b> {{ $ticket->status }}.
                </label>
                <br><br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-12" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 2px;">

                @if(auth()->user()->role == 1)
                  <span style="margin-left: 87%;">
                    <button id="locklock" class="btn btn-outline-primary">
                      <i data-feather="unlock"></i>
                    </button>
                  </span>
                @endif
                <form method="POST" action="{{ route('ticketBodyUpdate') }}">
                  @csrf
                  <table class="table table-bordered table-sm table-light">
                    <tr>
                      <td>
                        <div>
                          <div>
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <b>Subject: </b> 
                          </div>
                            <div class="form-group lock-unlock">
                              <input class="form-control" type="text" name="title" value="{!! $ticket->title  !!}">
                            </div>
                            @error('title')
                              <div class="text-danger">* {{ $message }}</div>
                            @enderror

                            <div class="unlock-lock">
                              {!! $ticket->title !!}
                            </div>
                        </div>
                        <br>
                        <div>
                          <b>Description: </b>
                            <div class="form-group lock-unlock">
                              <textarea class="summernote-simple" name="description">{!! $ticket->description !!}</textarea>
                              @error('description')
                                <div class="text-danger">* {{ $message }}</div>
                              @enderror
                            </div>
                            <div class="unlock-lock">
                              {!! $ticket->description !!}
                            </div>    
                        </div>
                        <br>
                        <div>
                          @if($ticket->attachment != null)
                            <b>Attachment:</b>
                            @foreach(json_decode($ticket->attachment, true) as $attachment)
                            
                              <a href="/assets/attachment/{{ $attachment }}" target="_blank">{{ $attachment }}</a>&nbsp;
                              <!-- @if(auth()->user()->role == 1)
                                <a href="#" data-toggle="modal" data-target="#file-delete" id="conform-modal"><i class="ion-close-round lock-unlock" style="color: red; border: 1px solid red"></i></a>,&nbsp;
                              @endif -->
                            
                            @endforeach
                          @endif
                        </div>
                        <br>
                        <div class="form-group lock-unlock"> 
                          <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Save
                          </button>
                        </div>
                          
                      </td>
                    </tr>
                  </table> 
                </form>        

                  <table class="table table-bordered table-sm table-light">

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
                            (jpg,png,gif,txt,pdf,docx,xlsx files are allowed) Max: 5MB
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

              <div class="col-md-6 col-sm-12" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 2px;">
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
              <div class="form-group col-md-6 col-sm-12" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 2px; height: 600px; overflow-y: scroll;">
                <div>
                  <b>Notes: </b>
                </div>
                <hr>
                
                <table class="table table-bordered table-sm table-light" id="show-more-notes">

                  
                </table>  
                <div id="no-more-notes"></div>
                <button id="more-notes" onclick="getNotes({{ $ticket->id }})" class="btn btn-outline-warning btn-sm" style="margin-left: 80%; margin-bottom: 10px;">More Notes</button>

              </div>

              <div class="form-group col-md-6 col-sm-12" style="border-style:solid;border-width: 1px 1px 1px 1px;border-radius: 2px; height: 600px; overflow-y: scroll;">
                <div>
                  <b>History: </b>
                </div>
                <hr>
                
                <table class="table table-bordered table-sm table-light">
                @foreach($histories as $history)
                  <tr style="border-style:solid;border-width: 0px 0px 5px 0px; border-color: #E8F8F5;border-radius: 2px;">
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

<div class="modal fade bd-example-modal-lg" id="file-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="myLargeModalLabel"><b>Client Details: </b></h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="detailCustomers">
          <form method="POST" action="">
            @csrf

            <input type="hidden" name="id" value="">
            <div class="row">
              <div class="form-group col-md-12">
                <h4>Do you want to delete? </h4>
              </div>
              <p></p>
            </div>
            
            <div class="row">
              <div class="col-md-3">
               
              </div>
              <div class="form-group col-md-6">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                  <span aria-hidden="true">&times;Cancel</span> 
                </button>
                <button type="submit" class="btn btn-danger btn-sm">
                  Confirm Delete
                </button>
              </div>

              <div class="col-md-3">
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
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

<script>
  $(document).ready(function(){
    $('#locklock').click(function(){
      $('.lock-unlock').toggle();
      $('.unlock-lock').toggle();
      $('#file_delete').toggle();
    });
  });
</script>

<script>
  var page = 1;
  function getNotes(ticket_id)
  {

    $.ajax({
      type: "GET",
      url: "/getNotesByTicket?ticket_id=" + ticket_id + "& page=" + page,

      success: function(data)
      {
        page++;

        if(data.length == 0)
        {
          $('#no-more-notes').text("");
          $('#more-notes').hide();
          $('#no-more-notes').text("No more notes!");
        }

        $('#show-more-notes').append(data);
      },

      error: function(error)
      {
        console.log(error);
      },

    });
  }

  getNotes({{ $ticket->id }});

</script>

@endpush