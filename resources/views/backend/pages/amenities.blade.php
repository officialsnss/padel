
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('amenity.create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($amenities as $amenity)
                    <tr>
                      <td></td>
                      <td>{{ $amenity->name }}</td>
                     
                       
                       <td>
                        <a href="{{ route('amenity.edit',$amenity->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('amenity.delete',$amenity->id)}}" class="btn btn-danger">Delete</a>
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
  