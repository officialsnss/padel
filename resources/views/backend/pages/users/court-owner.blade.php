
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($courtUsers as $courtUser)
                    <tr>
                      <td></td>
                      <td>{{ $courtUser->name }}</td>
                      <td>{{ $courtUser->email }}</td>
                     @if($courtUser->status === '1')
                        <td >Active</td>
                      @else
                        <td>Inactive</td>
                       @endif 
                       
                       <td><a href="{{ route('customer.view',$courtUser->id)}}" class="btn btn-secondary">View</a>
                     
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
  