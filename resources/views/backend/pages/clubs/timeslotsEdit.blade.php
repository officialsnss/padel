@extends('backend.layouts.app')
@section('content')
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body reset-form">
              <form name="checkForm" method="post" id="time_update" action="{{ route('club.timeslots.update', $timeslot->id) }}">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <tr>
                  
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                  <tr>
                   
                      <td><input class="form-control timePicker" type='text' id='start' value="{{  date('H:i', strtotime($timeslot->start_time))  }}" name='start_time'/></td>
                      <td><input class="form-control timePicker" type='text' id='end' value="{{ date('H:i', strtotime($timeslot->end_time)) }}" name='end_time'/> </td>
                    </tr>
                  </table>
                 
                  <button type="submit" class="btn btn-success save">Save</button>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>


        @endsection

        