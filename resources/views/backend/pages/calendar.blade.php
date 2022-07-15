
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
          
                <div class="card-body">
                   <div id='full_calendar_events'></div>
                   <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Booking Details</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div id="modalBody" class="modal-body">
                                         <p><strong>Club Name: </strong><span class="club"></span></p>
                                         <p><strong>Booking Date: </strong><span class="book_date"></span></p>
                                         <p><strong>Customer Name: </strong><span class="uname"></span></p>
                                         <p><strong>Customer Email: </strong><span class="user_email"></span></p>
                                        </div>
                                  </div>
                              </div>
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
      
      $(document).ready(function() {
        $('#full_calendar_events').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
        
          eventRender: function (event, element) {
            element.find('.fc-title').html(event.title);/*For Month,Day and Week Views*/
            element.find('.fc-list-item-title').html(event.title);/*For List view*/
          }, 
          navLinks: true, // can click day/week names to navigate views
          timeFormat: 'H:mm',
          eventLimit: true, // allow "more" link when too many events
          events: <?php echo json_encode($events); ?>,
          eventColor: '#378006',
          borderColor : '#000',
          eventClick:  function(arg) {
             $('#modalBody .club').text(arg.title);
             $('#modalBody .user_email').text(arg.email);
             $('#modalBody .uname').text(arg.uname);
             $('#modalBody .book_date').text(arg.booking_date);
             $('#calendarModal').modal();
         },
        });
      });
    
</script>

         @endsection