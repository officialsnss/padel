@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row filter-row">
                        <div class="col-md-12">
                            <form action="" method="post" id="date-filter">
                                <div class="item">
                                    <label>Status</label>
                                    <select id="match_filter" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1">Upcomming</option>
                                        <option value="2">Played</option>
                                        <option value="3">Cancelled</option>
                                    </select>
                                </div>
                                <div class="item filter-btn">
                                    <button type="button" name="filter" id="filter"
                                        class="btn btn-primary">Filter</button>

                                </div>
                                <div class="item filter-btn">
                                    <button type="button" name="refresh" id="refresh"
                                        class="btn btn-warning">Refresh</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Club Name</th>
                                <th>Image</th>
                                <th>Match Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($matchs as $match)
                                <tr>
                                    <td></td>
                                    <td>{{ $match['name'] }}</td>
                                    <td>
                                        <div id="image-holder">
                                            @if ($match['featured_image'])
                                                <img src="{{ URL::to('/') }}/Images/club_images/{{ $match['featured_image'] }}"
                                                    class="thumb-image-list">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            if ($match['status'] == 1) {
                                                $status = 'Upcomming';
                                            } elseif ($match['status'] == 2) {
                                                $status = 'Played';
                                            } else {
                                                $status = 'Cancelled';
                                            }
                                            echo $status;
                                        @endphp
                                    </td>
                                    <td>@php
                                        echo date('d-M-Y',strtotime($match['created_at']))
                                    @endphp</td>
                                    <td>
                                        @php
                                            if ($match['status'] == 2) {
                                        @endphp
                                        <a href="{{ route('matches.edit', $match['id']) }}"
                                            class="btn btn-secondary">Edit Result</a>
                                        @php
                                            }
                                        @endphp
                                        <a href="{{ route('matches.view', $match['id']) }}" class="btn btn-primary">View</a>

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
    <script>
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                dateFormat: 'yy-mm-dd',
                autoclose: true
            });

            load_data();

            function load_data(from_date = '', to_date = '', club_id = '', order_status = '', payment_type = '') {
                $('#order_table').DataTable({
                    processing: true,
                    dom: 'Bfrtip',

                    serverSide: true,
                    buttons: [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: [

                            {
                                extend: 'copy',
                                messageTop: function() {
                                    $topData = $('.summary-view').text();
                                    return $topData
                                },
                            },
                            {
                                extend: 'pdf',
                                messageTop: function() {
                                    $topData = $('.summary-view').text();
                                    return $topData
                                },
                            },
                            {
                                extend: 'print',
                                messageTop: function() {
                                    $topData = $('.summary-view').text();
                                    return $topData
                                },
                            },


                        ]
                    }],
                    ajax: {
                        url: '{{ route('reports') }}',
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            club_id: club_id,
                            order_status: order_status,
                            payment_type: payment_type
                        }
                    },
                    columns: [{
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'clubname',
                            name: 'clubname'
                        },
                        {
                            data: 'usremail',
                            name: 'usremail'
                        },
                        {
                            data: 'booking_date',
                            name: 'booking_date'
                        },
                        {
                            data: 'commission',
                            name: 'commission'
                        },
                        {
                            data: 'booked_status',
                            render: function(data) {
                                if (data == '1') {
                                    return "Booked"
                                } else if (data == '3') {
                                    return "Cancellation"
                                } else {
                                    return "Pending"
                                }
                            },
                            name: 'booked_status'
                        },
                        {
                            data: 'payment_method',
                            render: function(data) {
                                if (data == '1') {
                                    return "KNET"
                                } else {
                                    return "COD"
                                }
                            },
                            name: 'payment_method'
                        },
                        {
                            data: 'pay_status',
                            render: function(data) {
                                if (data == '1') {
                                    return "Completed"
                                } else {
                                    return "Pending"
                                }
                            },
                            name: 'pay_status'
                        },
                        {
                            data: 'booking_created_at',
                            name: 'booking_created_at'
                        },


                    ],
                    "headerCallback": function(thead, data, start, end, display) {
                        var api = this.api();
                        var ttotal = api.ajax.json().ttotal
                        var cancel = api.ajax.json().cancel
                        var refund = api.ajax.json().refund
                        $('.cancel-b').html(cancel);
                        $('.total-b').html(ttotal + ' KWD');
                        $('.refund').html(refund + ' KWD');


                    }

                });
            }

            $('#filter').click(function() {

                var status = $('#match_filter').val();
                $.ajax({
                    url:"{{ route('admin.matches') }}",
                    type:"GET",
                    data:{'status':status},
                    success:function(data){
                        console.log(data);
                        var matches = data.matchs;
                        var html = "";
                        if(matches.length > 0){
                            let j = 0;
                            const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                            for(let i = 0; i < matches.length; i++){
                                let matchId = matches[i]['id'];
                                let editRoute = "{{ route('matches.edit', ":editid") }}";
                                editRoute = editRoute.replace(':editid', matches[i]['id']);
                                let viewRoute = "{{ route('matches.view', ":viewid") }}";
                                viewRoute = viewRoute.replace(':viewid', matches[i]['id']);
                                let hidden = "";
                                if(matches[i]['status'] == 2){
                                    match_status_response = "Played";
                                    hidden = "";
                                } else if(matches[i]['status'] == 1){
                                    match_status_response = "Upcoming";
                                    hidden = "hidden";
                                } else {
                                    match_status_response = "Cancelled";
                                    hidden = "hidden";
                                }
                                var date = new Date(matches[i]['created_at']);
                                var day = date.getDate();
                                var month = months[date.getMonth()];
                                var year = date.getFullYear();

                                var getUrl = window.location;
                                var baseUrl = getUrl .protocol + "//" + getUrl.host;

                                html += '<tr>\
                                    <td>'+i+'</td>\
                                    <td>'+matches[i]['name']+'</td>\
                                    <td><img src="'+baseUrl+'/Images/club_images/'+matches[i]['featured_image']+'" class="thumb-image-list"></td>\
                                    <td>'+match_status_response+'</td>\
                                    <td>'+day + '-' + month + '-' + year+'</td>\
                                    <td><a href="'+editRoute+'" class="btn btn-secondary" '+hidden+'>Edit Result</a>\
                                        <a href="'+viewRoute+'" class="btn btn-primary">View</a>\
                                        </td>\
                                    </td>';
                            }
                        } else {
                            html += '<tr>\
                                    <td colspan="6" class="text-center">No matching records found</td>\
                                    </td>';
                        }
                        $("#tbody").html(html);
                    }
                });


            });


            $('#refresh').click(function() {
                $('#clubs-filter').val('');
                $('#example1').DataTable().destroy();
                load_data();
            });



        });
    </script>
@endsection
