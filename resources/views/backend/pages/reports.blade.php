
@extends('backend.layouts.app')
@section('content')

<div class="row report-table">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row filter-row">
                     <div class="col-md-12">
                        <form action="" method="post" id="date-filter">
                         <div class="item">
                          <label>From:</label>
                          <input type="text"  id="from_date" value="" class="form-control input-daterange" name="from_date">
                          </div>
                          <div class="item">
                          <label>To:</label>
                          <input type="text"  id="to_date" value="" class="form-control input-daterange" name="to_date">
                          </div>
                          @if(auth()->user()->role != '5')
                          <div class="item">
                          <label>Select Club</label>
                            <select id="clubs-filter" class="form-control">
                              <option value="">Select Club</option>
                              @foreach($clubs as $club)
                                  <option value="{{ $club->id }}">{{ $club->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          @endif
                          <div class="item">
                          <label>Select Payment Method</label>
                            <select id="payment_type" class="form-control">
                              <option value="">Select Payment Method</option>
                              <option value="1">KNET</option>
                              <option value="2">COD</option>
                             
                             </select>
                          </div>
                          <div class="item">
                          <label>Status</label>
                            <select id="order_status" class="form-control">
                              <option value="">Select Status</option>
                              <option value="1">Booked</option>
                              <option value="3">Cancellation</option>
                             
                             </select>
                          </div>
                          <div class="item filter-btn">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                         
                          </div>
                          <div class="item filter-btn">
                            <button type="button" name="refresh" id="refresh" class="btn btn-warning">Refresh</button>
                          </div>
                      </form>
                      </div>
                      
                     
                      </div>
                      <div class="summary-view" style="margin-bottom:20px">
                          <strong>Total Amount: </strong><span class="total-b"></span><br>
                          <strong>Total Cancellation: </strong><span class="cancel-b">0</span><br>
                          <strong>Total Refunded Amount:</strong><span class="refund"></span><br>
                      </div>
            <div class="table-responsive">
                <table id="order_table" class="table table-bordered table-striped" style="width:100%">
                  <thead>
     
                  <tr>
                    <th>Order Number</th>
                    <th>Club Name</th>
                    <th>User Email</th>
                    <th>Booking Date</th>
                    <th>Commission(in %)</th>
                    <th>Status</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Order Date-Time</th>
                    
                 </tr>
                  </thead>
                
                 
                </table>
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
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  dateFormat: 'yy-mm-dd',
  autoclose:true
 });
 
 load_data();
 
 function load_data(from_date = '', to_date = '', club_id ='',order_status='', payment_type='')
 {
  $('#order_table').DataTable({
   processing: true,
   dom: 'Bfrtip',
   
   serverSide: true,
   buttons: [
          {
                extend: 'collection',
                text: 'Export',
                // buttons: [
                //     'copy',
                //     'excel',
                //     'csv',
                //     'pdf',
                //     'print'
                // ],
                buttons: [
           
            {
                extend: 'copy',
                messageTop: function () {
                  $topData =  $('.summary-view').text();
                  return $topData
                },
            },
            {
                extend: 'pdf',
                messageTop: function () {
                  $topData =  $('.summary-view').text();
                  return $topData
                },
            },
            {
                extend: 'print',
                messageTop: function () {
                  $topData =  $('.summary-view').text();
                  return $topData
                },
            },

         
        ]
            }
        ],
   ajax: {
    url:'{{ route("reports") }}',
    data:{from_date:from_date, to_date:to_date,club_id:club_id,order_status:order_status,payment_type:payment_type}
   },
   columns: [
    {
     data:'order_id',
     name:'order_id'
    },
    {
     data:'clubname',
     name:'clubname'
    },
    // {
    //  data:'usrname',
    //  name:'usrname'
    // },
    {
     data:'usremail',
     name:'usremail'
    },
    {
     data:'booking_date',
     name:'booking_date'
    },
    {
     data:'commission',
     name:'commission'
    },
    {
     data:'booked_status',
     render : function(data)
      {
          if (data == '1') {
            return "Booked" 
          }else if(data == '3'){
            return "Cancellation"
          }
          else{
            return "Pending"
          }
      },
     name:'booked_status'
    },
    {
     data:'payment_method',
     render : function(data)
      {
          if (data == '1') {
            return "KNET" 
          }
          else{
            return "COD"
          }
      },
     name:'payment_method'
    },
    {
     data:'pay_status',
     render : function(data)
      {
          if (data == '1') {
            return "Completed" 
          }
          else{
            return "Pending"
          }
      },
     name:'pay_status'
    },
    {
     data:'booking_created_at',
     name:'booking_created_at'
    },
   
   
   ],
   "headerCallback": function( thead, data, start, end, display) {
    var api = this.api();
    var ttotal = api.ajax.json().ttotal
    var cancel = api.ajax.json().cancel
    var refund = api.ajax.json().refund
    $('.cancel-b').html(cancel);
    $('.total-b').html(ttotal+' KWD');
    $('.refund').html(refund+' KWD');
   
     
  }
  
  });
 }
 
 $('#filter').click(function(){

  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var club_id = $('#clubs-filter').val();
  var order_status = $('#order_status').val();
  var payment_type = $('#payment_type').val();
  if(from_date != '' || to_date != '' ||  club_id != '' || order_status != '' || payment_type != '')
  {
   $('#order_table').DataTable().destroy();
   var resr = load_data(from_date, to_date, club_id,order_status,payment_type);
 
  }

 
 });
 
 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#clubs-filter').val('');
  $('#order_status').val('');
  $('#order_table').DataTable().destroy();
  load_data();
 });


 
});
</script>
        </script>
        @endsection
  