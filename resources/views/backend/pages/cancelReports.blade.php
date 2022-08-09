
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
                          <label>Select Start Date</label>
                          <input type="text"  id="from_date" value="" class="form-control input-daterange" name="from_date">
                          </div>
                          <div class="item">
                          <label>Select End Date</label>
                          <input type="text"  id="to_date" value="" class="form-control input-daterange" name="to_date">
                          </div>
                          <div class="item">
                          <label>Select Court</label>
                            <select id="clubs-filter" class="form-control">
                              <option value="">Select Court</option>
                              @foreach($clubs as $club)
                                  <option value="{{ $club->id }}">{{ $club->name }}</option>
                              @endforeach
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
                   <table id="order_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   
                    <th>Club Name</th>
                    <th>User Email</th>
                    <th>Booking Date</th>
                    <th>Total Amount(In KWD)</th> 
                    <th>Refund Amount(In KWD)</th>
                 </tr>
                  </thead>
                
                
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
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  dateFormat: 'yy-mm-dd',
  autoclose:true
 });
 
 load_data();
 
 function load_data(from_date = '', to_date = '', club_id ='')
 {
  $('#order_table').DataTable({
   processing: true,
   dom: 'Bfrtip',
   serverSide: true,
   buttons: [
          {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
   ajax: {
    url:'{{ route("reports.cancel") }}',
    data:{from_date:from_date, to_date:to_date,club_id:club_id}
   },
   columns: [
   
    {
     data:'clubname',
     name:'clubname'
    },
    {
     data:'usremail',
     name:'usremail'
    },
    {
     data:'booking_date',
     name:'booking_date'
    },
    {
     data:'total_amount',
     name:'total_amount'
    },
    {
     data:'refund_amt',
     name:'refund_amt'
    },
   ]
  });
 }
 
 $('#filter').click(function(){

  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var club_id = $('#clubs-filter').val();
 
  if((from_date != '' || to_date != '' ||  club_id != ''))
  {
   $('#order_table').DataTable().destroy();
   load_data(from_date, to_date, club_id);
  }

 
 });
 
 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#clubs-filter').val('');
  $('#order_table').DataTable().destroy();
  load_data();
 });
 
});
</script>
        </script>
        @endsection
  