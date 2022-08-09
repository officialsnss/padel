
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              
              <div class="card-body">
               
              
              <table id="tableplayers" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Order No</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody id="tablecontentss">
                    
                    @foreach($players as $player)
                    <tr class="row1" data-id="{{ $player->id }}">
                    <td class="pl-3"><i class="fa fa-sort"></i></td>
                      <td>{{ $player->name }}</td>
                      <td>{{ $player->email }}</td>
                      <td>{{ $player->ordering }}</td>
                      <td><input type="checkbox" data-id="{{ $player->id }}" name="popular" class="js-switch-player" {{ $player->isPopular == 1 ? 'checked' : '' }}></td>
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
        <div id="loader" class="lds-dual-ring hidden overlay"></div>

        <script type="text/javascript">
      $(function () {
         var datatable = $("#tableplayers").DataTable();

        $( "#tablecontentss" ).sortable({
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
            url: "{{ url('admin/players/reorder') }}",
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
  