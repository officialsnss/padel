
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <div class="add">
                 <a href="" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                <div class="col-md-8">
                    </div>
                  <div class="col-md-4">
                     <form action="" method="post" id="date-filter">
                         <label>Select Date</label>
                         <input type="text"  id="datepicker" value="" class="form-control">
                    </form>
                 </div>
                </div>
                <div class="book-time">
                    <ul class="time-list">
                       @foreach($clubtimings as $clubtime)
                    <?php
                
                     $indoorbooking =   \App\Models\Booking::where(['slot_id' => $clubtime->id, 'booking_date'=> date('Y-m-d'),'court_type' => '1'])
                       ->count();
                      $outdoorbooking =   \App\Models\Booking::where(['slot_id' => $clubtime->id, 'booking_date'=> date('Y-m-d'),'court_type' => '2'])
                       ->count();
                      $rem_indoor = $indoorCourts -  $indoorbooking;
                      $rem_outdoor = $outdoorCourts - $outdoorbooking;
                     ?>
                         <li><div class="b-time" style="{{ ($rem_indoor != 0 && $rem_outdoor != 0)?'background:#fff;':'background:#e74c3c;color:#fff'}}"><strong>{{ date('H:i',strtotime($clubtime->start_time)) }} - {{ date('H:i', strtotime($clubtime->end_time)) }}</strong>
                         @if($rem_indoor != 0 && $rem_outdoor)  
                            <p class="inner-des">
                              <small><b>Courts Available:</b><br>
                              @if($rem_indoor != 0)
                               {{ $rem_indoor }} Indoor<br>
                               @endif
                               @if($rem_outdoor != 0)
                              {{  $rem_outdoor }} Outdoor
                              @endif
                       </small></p>
                          @else
                          <h4>Booked</h4>
                          @endif

                            </div>

                        </li>
                       @endforeach
                    </ul>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <script>
  $( function() {
   
    $('#datepicker').datepicker({  dateFormat: 'dd-mm-yy' });
    $('#datepicker').datepicker().datepicker('setDate', 'today');
  } );

  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#datepicker").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      var inputData = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
     $.ajax({ 
        type: "GET", 
        url: '{{ route('club.timeslots.book.fetch') }}',
        data: {'inputData':inputData}, 
        success: function(result){ 
          
          $(".time-list").html(result); 
        }
      });

    });
  });
  
  </script>
        @endsection
  