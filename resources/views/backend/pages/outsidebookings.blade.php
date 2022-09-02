
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
      
                <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Club Name</th>
                    <th>Email</th>
                    <th>Booking Date</th>
                    <th>Time Slot</th>
                    <th>Court Type</th>
                    <th>Notes</th>
                    <th>Actions</th>
                 </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($out_bookings as $booking)
                    <tr>
                      <td></td>
                      <td>{{ $booking->name }}</td>
                      <td>{{ $booking->user_email }}</td>
                      <td>{{ date('d-m-Y', strtotime($booking->booking_date)) }}</td>
                      <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                      <td>@if($booking->court_type == '1')
                        {{ 'Indoor' }}
                        @else 
                        {{ 'Outdoor' }}
                        @endif
                      </td>
                      <td>{{ ($booking->notes)?$booking->notes:'-' }}</td>
                    
                     <td><a href="{{ route('bookings.outside.delete',$booking->oid ) }}" class="btn btn-success">Delete</a></td>
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

        @endsection
  