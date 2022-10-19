@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->role == '4')
                        <div class="add">
                            <a href="{{ route('holiday.create') }}" class="btn btn-info">Apply OFF</a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>End Date</th>
                                <th>End Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($holidays as $holiday)
                                <tr>
                                    <td></td>
                                    <td>
                                        @if ($holiday->type == '1')
                                        Days Leave
                                        @endif
                                        @if ($holiday->type == '2')
                                        Short Leave
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($holiday->start_date)) }}</td>
                                    <td>
                                        @if ($holiday->start_time == null)
                                        <center>-</center>
                                        @else
                                            {{ $holiday->start_time }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($holiday->end_date == null)
                                        <center>-</center>
                                        @else
                                            {{ date('d-m-Y', strtotime($holiday->end_date)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($holiday->end_time == null)
                                        <center>-</center>
                                        @else
                                            {{ $holiday->end_time }}
                                        @endif
                                    </td>
                                    <td>{{ $holiday->reason }}</td>
                                    <td>
                                        @if ($holiday->cstatus == '0')
                                            <p class="text-danger">Rejected</p>
                                        @elseif($holiday->cstatus == '1')
                                            <p class="text-success">Accepted</p>
                                        @else
                                            <p class="text-info">Request for Approval</p>
                                        @endif
                                    </td>


                                    <td>
                                        @if ($holiday->cstatus == '2' && auth()->user()->role == '4')
                                            <a href="{{ route('holiday.edit', $holiday->cid) }}"
                                                class="btn btn-secondary">Edit</a>
                                        @endif
                                        @if ($holiday->cstatus == '2' && (auth()->user()->role == '1' || auth()->user()->role == '2'))
                                            <a href="{{ route('holiday.approve', $holiday->cid) }}"
                                                class="btn btn-success">Approve</a>
                                            <a href="{{ route('holiday.reject', $holiday->cid) }}"
                                                class="btn btn-danger">Reject</a>
                                        @endif
                                        @if (auth()->user()->role == '4')
                                            <a href="{{ route('holiday.delete', $holiday->cid) }}"
                                                class="btn btn-danger">Delete</a>
                                        @endif



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
@endsection
