@extends('backend.layouts.app')
@section('content')
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body reset-form">
              <form method="post" action="{{ route('club.timeslots.save',  $clubId) }}">
              {{ csrf_field() }}
              <table class="table table-bordered">
                <tr>
                    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                    <th>S. No</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                  <tr>
                      <td><input type='checkbox' class='chkbox'/></td>
                      <td><span id='sn'>1.</span></td>
                      <td><input class="form-control timePicker" type='text' id='start' name='start_time[]'/></td>
                      <td><input class="form-control timePicker" type='text' id='end' name='end_time[]'/> </td>
                    </tr>
                  </table>
                  <button type="button" class='btn btn-danger delete'>- Delete</button>
                  <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                  <button type="submit" class="btn btn-success save">Save</button>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>

    <script type="text/javascript">
          
          $(".delete").on('click', function() {
           $('.chkbox:checkbox:checked').parents("tr").remove();
           $('.check_all').prop("checked", false); 
           updateSerialNo();
         });
         var i=$('table tr').length;
         $(".addbtn").on('click',function(){
           count=$('table tr').length;
           
             var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
               data+="<td><span id='sn"+i+"'>"+count+".</span></td>";
               data+="<td><input class='form-control timePicker' type='text' id='start"+i+"' name='start_time[]'/></td>";
               data+="<td><input class='form-control timePicker' type='text' id='end"+i+"' name='end_time[]'/></td></tr>";
           $('table').append(data);
           i++;
           $(".timePicker").hunterTimePicker();
         });
                 
         function select_all() {
           $('input[class=chkbox]:checkbox').each(function(){ 
             if($('input[class=check_all]:checkbox:checked').length == 0){ 
               $(this).prop("checked", false); 
             } else {
               $(this).prop("checked", true); 
             } 
           });
         }
         function updateSerialNo(){
           obj=$('table tr').find('span');
           $.each( obj, function( key, value ) {
             id=value.id;
             $('#'+id).html(key+1);
           });
         }

      
         </script>
 
        @endsection

        