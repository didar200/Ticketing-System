<form>
                    
  <div class="row">

    <div class="form-group col-6">
      <label><b>Subject: </b>{{ $emailHistory->subject }}</label>
    </div>

  </div>

  <div class="row">
    <div class="form-group col-6">
      <label><b>Body: </b>{!! $emailHistory->body !!}</label>
    </div>

  </div>


  <div class="row">
    <div class="form-group col-6">
        <label><b>Attachment: </b><a href="{{ $emailHistory->attachment }}" target="_blank">{{ $emailHistory->attachment }}</a></label>
    </div>

  </div>


</form>