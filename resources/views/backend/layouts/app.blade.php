<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sports Arena Project</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/adminlte.min.css')}}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/css/timePicker.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <link rel="stylesheet" href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}">

  <!-- jQuery -->
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery-validation/additional-methods.js')}}"></script>
  <script src="{{asset('assets/backend/js/fonts.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('backend.layouts.partials.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

  @include('backend.layouts.partials.breadcrumb')
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  @include('backend.layouts.partials.footer')
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/backend/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/backend/js/demo.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/backend/js/validation.js')}}"></script>
<!-- Timepicker -->

<script src="{{asset('assets/backend/js/jquery-timepicker.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
  $(function () {
    $dataa = $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });

</script>

<script>let elemst = Array.prototype.slice.call(document.querySelectorAll('.js-switchess'));

    elemst.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });</script>
          <script>
            $(document).ready(function(){
        $('.js-switchess').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 2;
            let Id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('coach.update.status') }}',
                data: {'status': status, 'id': Id},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                }
            });
        });
    });
</script>

<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>
      <script>
        $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 2;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('users.update.status') }}',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
              }
        });
    });
});

</script>
<script>


  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('success') }}");
  @endif

  $(".timePicker").hunterTimePicker();

  $("#fileUpload").on('change', function () {

if (typeof (FileReader) != "undefined") {

    var image_holder = $("#image-holder");
    image_holder.empty();

    var reader = new FileReader();
    reader.onload = function (e) {
        $("<img />", {
            "src": e.target.result,
            "class": "thumb-image"
        }).appendTo(image_holder);

    }
    image_holder.show();
    reader.readAsDataURL($(this)[0].files[0]);
} else {
    alert("This browser does not support FileReader.");
}
});
</script>
<script>let elemss = Array.prototype.slice.call(document.querySelectorAll('.js-switchs'));

elemss.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>
      <script>
        $(document).ready(function(){
    $('.js-switchs').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let clubid = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('clubs.popular.status') }}',
            data: {'status': status, 'club_id': clubid},
            success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
              }
        });
    });
});

</script>

<script>let elemen = Array.prototype.slice.call(document.querySelectorAll('.js-switch-player'));

elemen.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>
      <script>
        $(document).ready(function(){
    $('.js-switch-player').change(function () {

        let status = $(this).prop('checked') === true ? 1 : 0;
        let playerid = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('players.popular.status') }}',
            data: {'status': status, 'player_id': playerid},
            success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
              }
        });
    });
});



</script>

</body>
</html>
