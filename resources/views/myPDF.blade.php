<!DOCTYPE html>
<html>
<head>
    <title>Booking Invoice</title>
</head>
<style type="text/css">
.row {
  
    width:100%;
    display:inline-block;
}
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    float:left;
    
}
.col-lg-4 {
    width:33.333333%;
    max-width: 33.333333%;
}
.col-lg-1 {
    width: 8.333333%;
    max-width: 8.333333%;
}
.col-lg-3 {
    width:25%;
    max-width: 25%;
}
.col-lg-8 {
    width:66.666667%;
    max-width: 66.666667%;
}
h5 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;
}
.clear{
  clear:both;
  float:none;
}
.text-primary {
    color: #007bff!important;
}
table {
    border-collapse: collapse;
}
table.details td {
    width: 50%;
}
.bookingdetails tr td, .bookingdetails tr {
    border: none !important;
    padding: 5px 0px;
    vertical-align: top;
}
table.details tr, table.details td {
    border: 1px solid #f2f2f2;
    padding: 10px 20px;
}
table.details {
    width: 100%;
}
</style>
<body>

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
                    <?php $lists = explode(',', $bookingInfo[0]->clubamenities);
                     ?>
                     @foreach($lists as $list)
                     <p>{{ $list }} </p>
                    @endforeach
              
                </div>
            </div> 
            <div class="clear"></div>
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
</body>
</html>