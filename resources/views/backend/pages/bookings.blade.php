
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Club Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                 </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($bookings as $booking)
                    <tr>
                      <td></td>
                      <td>{{ $booking->usrname }}</td>
                      <td>{{ $booking->usremail }}</td>
                      <td>{{ $booking->clubname }}</td>
                      <td> <select class="p_status form-control">
                       <option value="1" data-id="{{ $booking->payid }}" {{ ($booking->payment_status == '1')?'selected':'' }}>Completed</option>
                       <option value="2" data-id="{{ $booking->payid }}" {{ ($booking->payment_status == '2')?'selected':'' }}>Pending</option>
                       </select>
                        </td>
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

    $('.p_status').change(function () {
    
         var status = $(this).val(); 
         var bookId = $(this).find(':selected').attr('data-id');
        // alert(bookId);
         $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('payments.update.status') }}',
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
  