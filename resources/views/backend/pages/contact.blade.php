
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
             
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Date-Time</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($information as $info)
                    <tr>
                      <td></td>
                      <td>{{ $info->name }}</td>
                      <td>{{ str_replace("&nbsp;", "", substr(strip_tags($info->message),0, 100)) }} ...</td>
                      <td>{{ $info->send_time }}</td>
                      <td><a href="{{  route('contact.view',$info->contactid) }}" class="btn btn-success">View</a>
                       
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
  