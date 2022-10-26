
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
       @if(auth()->user()->role == 5)
            <div class="card-header">
                <div class="add">
                 <a href="{{ route('bookings.calendar') }}" class="btn btn-info">View calendar View</a>
                </div>
              </div>
       @endif
                <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Booking Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Club Name</th>
                   <!-- <th>Status</th> -->
                    @if( auth()->user()->role == '1' ||  auth()->user()->role == '2')
                    <th>Club Status</th>
                    <th>Coach Status</th>
                    @endif
                    <th>Actions</th>
                 </tr>
                  </thead>
                  <tbody>

                  @foreach ($bookings as $booking)
                    <tr>
                      <td></td>
                      <td>{{ $booking->order_id }}</td>
                      <td>{{ $booking->usrname }}</td>
                      <td>{{ $booking->usremail }}</td>
                      <td>{{ $booking->clubname }}</td>
                      <!-- <td> <select class="p_status form-control">
                       <option value="1" data-id="{{ $booking->payid }}" {{ ($booking->payment_status == '1')?'selected':'' }}>Completed</option>
                       <option value="2" data-id="{{ $booking->payid }}" {{ ($booking->payment_status == '2')?'selected':'' }}>Pending</option>
                       </select>
                        </td> -->
                        @if( auth()->user()->role == '1' ||  auth()->user()->role == '2')
                        <td> <select class="c_status form-control">
                       <option value="0" data-id="{{ $booking->bookId }}" {{ ($booking->club_status == '0')?'selected':'' }}>Not confirmed</option>
                       <option value="1" data-id="{{ $booking->bookId }}" {{ ($booking->club_status == '1')?'selected':'' }}>Confirmed</option>
                       </select>
                        </td>
                        <td>
                          @if($booking->coach_id)
                           <select class="co_status form-control">
                       <option value="0" data-id="{{ $booking->bookId }}" {{ ($booking->coach_status == '0')?'selected':'' }}>Not confirmed</option>
                       <option value="1" data-id="{{ $booking->bookId }}" {{ ($booking->coach_status == '1')?'selected':'' }}>Confirmed</option>
                       </select>
                          @else
                          {{ 'Coach Not booked' }}
                          @endif
                        </td>
                        @endif
                     <td><a href="{{ route('booking.view',$booking->bookId)}}" class="btn btn-success">View Details</a></td>
                  </tr>
                  @endforeach

                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
<script>

    // $('.p_status').change(function () {

    //      var status = $(this).val();
    //      var bookId = $(this).find(':selected').attr('data-id');
    //     // alert(bookId);
    //      $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: '{{ route('payments.update.status') }}',
    //         data: {'status': status, 'bookId': bookId},
    //         success: function (data) {
    //             toastr.options.closeButton = true;
    //             toastr.options.closeMethod = 'fadeOut';
    //             toastr.options.closeDuration = 100;
    //             toastr.success(data.message);
    //           }
    //     });
    // });


    $('.c_status').change(function () {

    var status = $(this).val();
    var bookId = $(this).find(':selected').attr('data-id');

    $.ajax({
       type: "GET",
       dataType: "json",
       url: '{{ route('bookings.update.clubstatus') }}',
       data: {'status': status, 'bookId': bookId},
       success: function (data) {
           toastr.options.closeButton = true;
           toastr.options.closeMethod = 'fadeOut';
           toastr.options.closeDuration = 100;
           toastr.success(data.message);
         }
   });
});

$('.co_status').change(function () {

    var status = $(this).val();
    var bookId = $(this).find(':selected').attr('data-id');

    $.ajax({
       type: "GET",
       dataType: "json",
       url: '{{ route('bookings.update.coachstatus') }}',
       data: {'status': status, 'bookId': bookId},
       success: function (data) {
           toastr.options.closeButton = true;
           toastr.options.closeMethod = 'fadeOut';
           toastr.options.closeDuration = 100;
           toastr.success(data.message);
         }
   });
});

  </script>
        @endsection
