
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('holiday.create') }}" class="btn btn-info">Apply Holiday</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($holidays as $holiday)
                    <tr>
                      <td></td>
                      <td>{{ $holiday->name }}</td>
                      <td>{{ $holiday->email }}</td>
                      <td>{{ date('d-m-Y', strtotime($holiday->start_date)) }}</td>
                      <td>{{ date('d-m-Y', strtotime($holiday->end_date)) }}</td>
                      <td>{{ $holiday->reason }}</td>
                        
                       <td>
                        <a href="{{ route('holiday.edit', $holiday->cid)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('holiday.delete', $holiday->cid)}}" class="btn btn-danger">Delete</a>
                      
                       
                       
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
  