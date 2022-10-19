@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="add">
                        <a href="{{ route('coach.create') }}" class="btn btn-info">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Experience(in Months)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($coaches as $coach)
                                <tr>
                                    <td></td>
                                    <td>{{ $coach->name }}</td>

                                    <td>{{ $coach->price }} {{ $coach->currencyCode }}</td>
                                    <td>{{ $coach->experience }} </td>

                                    <td>
                                        <a href="{{ route('coach.edit', $coach->cid) }}" class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('coach.delete', $coach->cid) }}" class="btn btn-danger">Delete</a>
                                        <a href="{{ route('offdays', $coach->id) }}" class="btn btn-success">Off-days</a>
                                        <a href="{{ route('coach.resetPassword', $coach->id)}}" class="btn btn-info">Reset Password</a>


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
