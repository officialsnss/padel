@extends('backend.layouts.app')
@section('content')
<div class="card">
   
        <div class="card-body">
        <div class="row" style="margin-bottom:22px;font-size:18px;">
        
          <div class="col-4 col-md-4 col-lg-4">
                <table class="details bookingdetails">
                  <tr>
                    <td><strong>Invoice ID:</strong></td>
                    <td>{{ $bookingInfo[0]->invoice }}</td>
                  </tr>
                  <tr>
                    <td><strong>Booking Id:</strong></td>
                    <td>{{ $bookingInfo[0]->bookingorderId }}</td>
                  </tr>
                  <tr>
                    <td><strong>Order Date:</strong></td>
                    <td>{{ date('d-m-Y', strtotime($bookingInfo[0]->orderDate)) }}</td>
                  </tr>
                </table>
          </div>
        </div>
        <div class="clear"></div>
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
                    <?php $lists = explode(',', $amenityList);
                     ?>
                     @foreach($lists as $list)
                     <p>- {{ $list }} </p>
                    @endforeach
              
                </div>
            </div> 
            <hr>
            <div class="row paymentinfo">
                <div class="col-8 col-md-8 col-lg-8">
                 
                </div>
                <div class="col-4 col-md-4 col-lg-4">
               
                <table class="details bookingdetails">
                  <tr>
                    <td><strong>Price:</strong></td>
                    <td>{{ $bookingInfo[0]->cprice }} {{ $bookingInfo[0]->unit }}</td>
                  </tr>
                  <tr>
                    <td><strong>Payments Method:</strong></td>
                    <td>{{ ($bookingInfo[0]->payment_method == 1)?'Instant':'Later' }}</td>
                  </tr>
                  @if($bookingInfo[0]->payment_method == '2')
                  <tr>
                    <td><strong>Advance Payment:</strong></td>
                    <td>{{ $bookingInfo[0]->advance_price }}</td>
                  </tr>
                  <tr>
                    <td><strong>Pending Price:</strong></td>
                    <td>{{ $bookingInfo[0]->pending_amount }} {{ $bookingInfo[0]->unit }}</td>
                  </tr>
                  @endif
                  
                  <tr>
                    <td><strong>Service Charge:</strong></td>
                    <td>{{ $bookingInfo[0]->service_charge }} {{ $bookingInfo[0]->unit }}</td>
                  </tr>
                  @if($bookingInfo[0]->discount_price)
                  <tr>
                    <td><strong>Discount:</strong></td>
                    <td>{{ $bookingInfo[0]->discount_price }} {{ $bookingInfo[0]->unit }}</td>
                  </tr>
                  @endif

                  <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td>{{ $bookingInfo[0]->total_amount }} {{ $bookingInfo[0]->unit }}</td>
                  </tr>
                </table>
                </div>
            </div>

            <div class="row">    
                <div class="bk-btn">
                <a href="{{ url ('admin/generate-invoice-pdf') }}/{{ $bookingInfo[0]->bookingid }}" onclick="#" class="btn btn-success">Print Invoice</a>
                  <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                </div>
            </div>
         
        </div>
        <!-- /.card-body -->
      </div>
        @endsection