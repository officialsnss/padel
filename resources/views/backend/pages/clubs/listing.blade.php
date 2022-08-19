
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              
              <div class="card-body">
              <p class="note"><strong>Note: </strong>Please drag and drop the row to change the order of the clubs.</p>
              
              <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Club Name</th>
                    <th>Order No</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody id="tablecontents">
                    
                    @foreach($clubs as $club)
                    <tr class="row1" data-id="{{ $club->id }}">
                    <td class="pl-3"><i class="fa fa-sort"></i></td>
                      <td>{{ $club->name }}</td>
                      <td>{{ $club->ordering }}</td>
                      <td><input type="checkbox" data-id="{{ $club->id }}" name="popular" class="js-switchs" {{ $club->isPopular == 1 ? 'checked' : '' }}></td>
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
        <!-- Image loader -->

        <div id="loader" class="lds-dual-ring hidden overlay"></div>

        <script type="text/javascript">
      $(function () {
         var datatable = $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
         // var token = $('meta[name="csrf-token"]').attr('content')
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
           
            type: "POST", 
            dataType: "json", 
            url: "{{ url('admin/clubs/reorder') }}",
             data: {
              order: order,
              _token: '{{csrf_token()}}'
            },
           
            success: function(response) {
               if (response.status == "200") {
                $('#loader').removeClass('hidden')
                  location.reload(true);
                } else {
                  console.log(response);
                }
            },
           
          });
        }
      });
    </script>
    

        @endsection
  