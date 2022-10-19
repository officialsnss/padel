
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
              <p class="note"><strong>Note: </strong>Please drag and drop the row to change the order of the clubs.</p>
              <table id="tablevendor" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Club Name</th>
                    <th>Order</th>
                    <th>Popularity</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody id="tablecontentt">

                  @foreach ($courtUsers as $courtUser)

                   <tr class="row1" data-id="{{ $courtUser->cid }}">
                   <td class="pl-3"><i class="fa fa-sort"></i></td>
                      <td>{{ $courtUser->name }}</td>
                      <td>{{ $courtUser->email }}</td>
                      <td>{{ $courtUser->clubname }}</td>
                      <td>{{ $courtUser->cordering }}</td>
                      <td><input type="checkbox" data-id="{{ $courtUser->cid }}" name="popular" class="js-switchs" {{ $courtUser->isPopular == 1 ? 'checked' : '' }}></td>
                      <td><input type="checkbox" data-id="{{ $courtUser->id }}" name="status" class="js-switch" {{ $courtUser->status == 1 ? 'checked' : '' }}></td>

                      <td><a href="{{ route('court-owners.view',$courtUser->id)}}" class="btn btn-info">View</a>
                      <a href="{{ route('club.edit', $courtUser->cid )}}" class="btn btn-secondary">Edit</a>
                      <a href="{{ route('club.images', $courtUser->cid )}}" class="btn btn-warning">Upload Images</a>
                      <a href="{{ route('court-owners.resetPassword', $courtUser->id)}}" class="btn btn-success">Reset Password</a>
                      </td>
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
 var datatable = $("#tablevendor").DataTable({

 });

$("#tablecontentt").sortable({
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
