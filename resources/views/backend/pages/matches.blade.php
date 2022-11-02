@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row filter-row">
                        <div class="col-md-12">
                            <form action="" method="post" id="order_filter">
                                <div class="row">
                                    <div class="item col-md-6">
                                        <label>Status</label>
                                        <select id="match_filter" class="form-control">
                                            <option value="0" selected disabled="false">Select Status</option>
                                            <option value="1">Upcomming</option>
                                            <option value="2">Played</option>
                                            <option value="3">Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="item filter-btn">
                                            <button type="button" name="refresh" id="refresh"
                                                class="btn btn-warning">Refresh</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="matches_table" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Club Name</th>
                                    <th>Image</th>
                                    <th>Match Status</th>
                                    <th>Date</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody id="tbody">
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

                            </tbody> --}}

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
        $(document).ready(function() {


            load_data();

            function load_data(match_status = '') {
                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host;
                $('#matches_table').DataTable({
                    processing: true,

                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.matches') }}",
                        data: {
                            status: match_status
                        },
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'clubname',
                            name: 'clubname'
                        },
                        {
                            "name": "clubimage",
                            "data": "clubimage",
                            "render": function (data, type, row, meta) {
                                return '<img src="'+baseUrl+'/Images/club_images/'+data+'" class="thumb-image-list">';
                            },
                            "title": "Image",
                            "orderable": true,
                            "searchable": true
                        },
                        {
                            data: 'status',
                            render: function(data) {
                                if (data == '1') {
                                    return "Upcomming"
                                } else if (data == '2') {
                                    return "Played"
                                } else {
                                    return "Cancelled"
                                }
                            },
                            name: 'status'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],

                });
            }

            $('#match_filter').change(function() {

                var match_status = $('#match_filter').val();

                if (match_filter != '') {
                    $('#matches_table').DataTable().destroy();
                    var resp = load_data(match_status);

                }


            });

            $('#refresh').click(function() {
                $('#match_filter').val('0');
                $('#matches_table').DataTable().destroy();
                load_data();
            });

        });
    </script>
@endsection
