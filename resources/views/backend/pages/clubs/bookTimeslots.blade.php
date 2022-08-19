
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
           
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
                    <?php $i = 1; ?>
                       @foreach($clubtimings as $clubtime)
                    <?php
                          
                      $indoorbooking =   \App\Models\Booking::where(['slot_id' => $clubtime->id, 'booking_date'=> date('Y-m-d'),'court_type' => '1'])
                       ->count();

                      $outsideindoorbooking =  DB::table('outside_bookings')->where(['slot_id' => $clubtime->id, 'booking_date'=> date('Y-m-d'),'court_type' => '1'])
                                                ->count();

                      $totalindoorbooking =  $indoorbooking+$outsideindoorbooking; 
                      $outdoorbooking =   \App\Models\Booking::where(['slot_id' => $clubtime->id, 'booking_date'=> date('Y-m-d'),'court_type' => '2'])
                       ->count();
                      $outsideoutdoorbooking =   DB::table('outside_bookings')->where(['slot_id' => $clubtime->id, 'booking_date'=>date('Y-m-d'),'court_type' => '2'])
                       ->count();
            
                      $totalOutdoorbooking = $outdoorbooking+$outsideoutdoorbooking; 

                      $rem_indoor = $indoorCourts -  $totalindoorbooking;
                      $rem_outdoor = $outdoorCourts - $totalOutdoorbooking;
                     ?>
                         <li>
                       
                          <div data-toggle="modal" data-target="#bookModal{{ $i }}" class="b-time" style="{{ (($rem_indoor > 0 && $rem_outdoor > 0) || $rem_indoor > 0 || $rem_outdoor > 0)?'background:#fff;cursor: pointer;':'background:#e74c3c;color:#fff'}}"><strong>{{ date('H:i',strtotime($clubtime->start_time)) }} - {{ date('H:i', strtotime($clubtime->end_time)) }}</strong>
                         @if(($rem_indoor > 0 && $rem_outdoor > 0) || $rem_indoor > 0 || $rem_outdoor > 0)  
                            <p class="inner-des">
                              <small><b>Courts Available:</b><br>
                              @if($rem_indoor > 0)
                               {{ $rem_indoor }} Indoor<br>
                               @endif
                               @if($rem_outdoor > 0)
                              {{  $rem_outdoor }} Outdoor
                              @endif
                       </small></p>
                          @else
                          <h4>Booked</h4>
                          @endif

                          <?php
                          
                            if($rem_indoor > 0){
                               $courttype = '<input type="radio" class="ctype" name="court_type" value="1" checked><span class="indoor_court">Indoor</span>';
                            }
                            if($rem_outdoor > 0){
                              $courttype = '<input type="radio" class="ctype" name="court_type" value="2" checked ><span class="outdoor_court">Outdoor</span>';
                            }
                            if($rem_indoor > 0 && $rem_outdoor > 0){
                                $courttype = '<input type="radio" class="ctype" name="court_type" value="1" checked><span class="indoor_court">Indoor</span><input type="radio" class="ctype" name="court_type" value="2"><span class="outdoor_court">Outdoor</span>';
                              }
                          ?>

                            </div>
                            @if(($rem_indoor > '0' && $rem_outdoor > '0') || $rem_indoor > '0' || $rem_outdoor > '0')  
                            <div class="modal fade" id="bookModal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Slot Booking</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                      
                                          <form method="post" action="{{ route('club.timeslots.booking.slot', $clubtime->id) }}" id="bookform" class="bookforms">
                                              @csrf
                                              <div class="form-group row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputName">Booking Date</label>
                                                        <input type="text" id="book_date" class="form-control" value="{{ date('d-m-Y') }}" name="book_date" readonly>
                                                            @error('book_date')
                                                            <div class="form-error">{{ $message }}</div>
                                                            @enderror
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="inputName">Time Slot</label>
                                                        <input type="text" id="book_slot" class="form-control" value="{{ date('H:i',strtotime($clubtime->start_time)) }} - {{ date('H:i', strtotime($clubtime->end_time)) }}" name="book_slot" readonly>
                                                            @error('book_slot')
                                                            <div class="form-error">{{ $message }}</div>
                                                            @enderror
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="inputName">Court Type</label>
                                                            <div class="ctype"> {!! $courttype !!}</div> 
                                                          </div>
                                                      </div>
                                                  </div>

                                            <div class="form-group row">
                                               <div class="col-md-12">
                                               <div class="form-group">
                                                        <label for="inputName">User Email</label>
                                                        <input type="text" id="user_email" class="form-control" value="" name="user_email">
                                                            @error('user_email')
                                                            <div class="form-error">{{ $message }}</div>
                                                            @enderror
                                                      </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                               <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label for="inputName">Notes</label>
                                                      <textarea rows="4" id="messagebody" class="form-control" value="" name="messagebody"></textarea>
                                                          @error('messagebody')
                                                          <div class="form-error">{{ $message }}</div>
                                                          @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                  <div class="col-md-12">
                                                      <button type="submit" class="btn btn-primary">
                                                        Book
                                                      </button>
                                                  </div>
                                              </div>
                                          </form>
                                       
                                      </div>
                                  </div>
                              </div>
                          </div>
                    
                <!--  End of POPUP-->
                    @endif
                            
                        </li>
                        <?php $i++; ?> 
                       @endforeach
                    </ul>
                  </div>
                  <p class="note"><strong>Note: </strong>Please click on the time slot to book it manually.</p>
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
   
    $('#datepicker').datepicker({  dateFormat: 'dd-mm-yy', minDate: 0 });
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
          $(".bookforms").each(function() { 
            var form = $(this);
              form.validate({

                rules: {
                  user_email: {
                  required: true,
                  email:true,
                }
                  
                },

                
              })
              });
        }
      });

    });
  });

 

  

  
  </script>
        @endsection
  