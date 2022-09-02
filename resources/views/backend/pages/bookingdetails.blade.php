@extends('backend.layouts.app')
@section('content')
<div class="card">
   
        <div class="card-body">
        <div class="row" style="margin-bottom:22px;font-size:18px;">
        
          <div class="col-4 col-md-4 col-lg-4">
                <table class="details bookingdetails">
                  <tr>
                    <td><strong>Invoice ID:</strong></td>
                    <td>{{ $bookingInfo->invoice }}</td>
                  </tr>
                  <tr>
                    <td><strong>Booking Id:</strong></td>
                    <td>{{ $bookingInfo->bookingorderId }}</td>
                  </tr>
                  <tr>
                    <td><strong>Order Date:</strong></td>
                    <td>{{ date('d-m-Y', strtotime($bookingInfo->orderDate)) }}</td>
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
                    <td>{{ $bookingInfo->usrname }}</td>
                  </tr>
                  <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $bookingInfo->usremail }}</td>
                  </tr>
                  <tr>
                    <td><strong>Phone:</strong></td>
                    <td>{{ $bookingInfo->phone }}</td>
                  </tr>
                  <tr>
                  <td><strong>Address:</strong></td>
                    <td>{{ $bookingInfo->address }}<br>
                    {{ $bookingInfo->region_id }}<br>
                    {{ $bookingInfo->city_id }}<br>
                    {{ $bookingInfo->zipcode }}<br>
                    {{ $bookingInfo->county }}
                    </td>
                  </tr>
                </table>
              </div>
                <div class="col-1 col-md-1 col-lg-1">
                 </div>

                <div class="col-3 col-md-3 col-lg-3">
                  <h5 class="text-primary">Booking Date</h5>
                  <p>{{ date('d-m-Y', strtotime($bookingInfo->bookdate)) }}</p>
                  
                  <h5 class="text-primary">Booking Time</h5>
                  <?php
                  $firstslot = \App\Models\BookingSlots::where(['booking_id' =>  $bookingInfo->bookid])->pluck('slots')->first();
                  $lastslot = \App\Models\BookingSlots::where(['booking_id' =>  $bookingInfo->bookid])->pluck('slots')->last();
                  $timestamp = strtotime($lastslot) + 60*60;
                  $lasttime = date('H:i', $timestamp);
                  ?>
                 <p>{{ $firstslot }} - {{ $lasttime }}</p>
                 
                  <h5 class="text-primary">Club Name</h5>
                  <p>{{ $bookingInfo->clubname }}</p>
                </div>  
                <div class="col-1 col-md-1 col-lg-1">
                 </div>
                <div class="col-3 col-md-3 col-lg-3">
                <h5 class="text-primary">Amenities Included</h5>
                    <?php $lists = explode(',', $amenityList);
                     ?>
                     @foreach($lists as $list)
                        @if($list != '')
                     <p>- {{ $list }} </p>
                        @endif
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
                    <td>{{ $bookingInfo->cprice }} {{ $bookingInfo->unit }}</td>
                  </tr>
                  <tr>
                    <td><strong>Payments Method:</strong></td>
                    <td>{{ ($bookingInfo->payment_method == 1)?'KNET':'COD' }}</td>
                  </tr>
                  <!-- @if($bookingInfo->payment_method == '2')
                  <tr>
                    <td><strong>Advance Payment:</strong></td>
                    <td>{{ $bookingInfo->advance_price }}  {{ $bookingInfo->unit }}</td>
                  </tr>
                  <tr>
                    <td><strong>Pending Price:</strong></td>
                    <td>{{ $bookingInfo->pending_amount }} {{ $bookingInfo->unit }}</td>
                  </tr>
                  @endif
                   -->
                  <tr>
                    <td><strong>Service Charge:</strong></td>
                    <td>{{ $bookingInfo->service_charge }} {{ $bookingInfo->unit }}</td>
                  </tr>
                  @if($bookingInfo->discount_price)
                  <tr>
                    <td><strong>Discount:</strong></td>
                    <td>{{ $bookingInfo->discount_price }} {{ $bookingInfo->unit }}</td>
                  </tr>
                  @endif

                  <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td>{{ $bookingInfo->total_amount }} {{ $bookingInfo->unit }}</td>
                  </tr>
                </table>
                </div>
            </div>

            <div class="row">    
                <div class="bk-btn">
                <a href="{{ url ('admin/generate-invoice-pdf') }}/{{ $bookingInfo->bookingid }}" onclick="#" class="btn btn-success">Print Invoice</a>
                  <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                </div>
            </div>
         
        </div>
        <!-- /.card-body -->
      </div>
        @endsection