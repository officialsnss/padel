
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <div class="add">
                 <a href="{{ route('club.timeslots.add', $clubId )}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach($clubtimings as $clubtime)
                    <tr>
                      <td></td>
                      <td>{{  date('H:i', strtotime($clubtime->start_time)) }}</td>
                      <td>{{ date('H:i', strtotime($clubtime->end_time)) }}</td>
                     
                     <td><a href="{{ route('club.timeslots.edit', $clubtime->id)}}" class="btn btn-secondary">Edit</a>
                     <a href="{{ route('club.timeslots.delete', $clubtime->id)}}" class="btn btn-danger">Delete</a>
                  @endforeach     
                      
                      
                       
                      </tr>
               
                  
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
  