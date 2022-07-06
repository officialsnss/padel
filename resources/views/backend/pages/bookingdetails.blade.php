@extends('backend.layouts.app')
@section('content')
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Booking Details</h3>
         </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
                <h5 class="text-primary">Customer Details</h5>
                <table class="details bookingdetails">
                  <tr>
                    <td><strong>Full Name:</strong></td>
                    <td>{{ $bookingInfo[0]->usrname }}</td>
                  </tr>
                  <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $bookingInfo[0]->usremail }}</td>
                  </tr>
                  <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{{ $bookingInfo[0]->phone }}</td>
                  </tr>
                  <tr>
                  <td><strong>Address:</strong></td>
                    <td>{{ $bookingInfo[0]->address }}<br>
                    {{ $bookingInfo[0]->region_id }}<br>
                    {{ $bookingInfo[0]->city_id }}<br>
                    {{ $bookingInfo[0]->zipcode }}<br>
                    {{ $bookingInfo[0]->county }}
                    </td>
                  </tr>
                </table>
              </div>
                <div class="col-1 col-md-1 col-lg-1">
                 </div>

                <div class="col-3 col-md-3 col-lg-3">
                  <h5 class="text-primary">Booking Date</h5>
                  <p>{{ $bookingInfo[0]->date }}</p>
                  
                  <h5 class="text-primary">Booking Time</h5>
                  <p>{{ $bookingInfo[0]->start_time }} - {{ $bookingInfo[0]->end_time }}</p>

                  <h5 class="text-primary">Club Name</h5>
                  <p>{{ $bookingInfo[0]->clubname }}</p>
                </div>  
                <div class="col-1 col-md-1 col-lg-1">
                 </div>
                <div class="col-3 col-md-3 col-lg-3">
                <h5 class="text-primary">Amenities Included</h5>
                </div>
            </div> 
            <div class="row">    
                <div class="bk-btn">
                  <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                </div>
            </div>
         
        </div>
        <!-- /.card-body -->
      </div>
        @endsection