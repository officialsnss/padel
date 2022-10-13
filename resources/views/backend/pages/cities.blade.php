
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('city.create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Country</th>
                    <th>Region</th>
                    <th>City Name</th>
                    <th>Arabic City Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($cities as $city)

                    <tr>
                      <td></td>
                      <td>{{ $city->cname }}</td>
                      <td>{{ $city->regionname }}</td>
                      <td>{{ $city->name }}</td>
                      <td>{{ $city->name_arabic }}</td>
                     <td>
                        <a href="{{ route('city.edit',$city->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('city.delete',$city->id)}}" class="btn btn-danger">Delete</a>
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
  