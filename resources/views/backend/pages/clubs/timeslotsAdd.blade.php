@extends('backend.layouts.app')
@section('content')
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body reset-form">
              <form name="checkForm" method="post" id="time_save" action="{{ route('club.timeslots.save',  $clubId) }}">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <tr>
                  
                    <th>Club Opening Time</th>
                    <th>Club Closing Time</th>
                </tr>
                  <tr>
                     <td><input class="form-control timePicker" type='text' id='start' name='start_time'/></td>
                      <td><input class="form-control timePicker" type='text' id='end' name='end_time'/> </td>
                    </tr>
                  </table>
                  <!-- <button type="button" class='btn btn-danger delete'>- Delete</button>
                  <button type="button" class='btn btn-success addbtn'>+ Add More</button> -->
                  <button type="submit" class="btn btn-success save">Save</button>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>

   
 
        @endsection

        