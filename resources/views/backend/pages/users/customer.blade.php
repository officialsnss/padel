
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers Listing</h3>
              </div>
              <!-- /.card-header -->
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
                    
                  @foreach ($appUsers as $appUser)
                    <tr>
                      <td></td>
                      <td>{{ $appUser->name }}</td>
                      <td>{{ $appUser->email }}</td>
                      <!-- @if($appUser->status === '1')
                        <td >Active</td>
                      @else
                        <td>Inactive</td>
                       @endif -->
                       <td><input type="checkbox" data-id="{{ $appUser->id }}" name="status" class="js-switch" {{ $appUser->status == 1 ? 'checked' : '' }}></td>
                       <td><a href="{{ route('customer.view',$appUser->id)}}" class="btn btn-success">View</a>
                      <a href="#" class="btn btn-info">Edit</a>
                      <a href="#" class="btn btn-danger">Delete</a></td>
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
  