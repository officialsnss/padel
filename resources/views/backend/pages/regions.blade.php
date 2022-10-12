
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('region.create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Country</th>
                    <th>Region Name</th>
                    <th>Arabic Region Name </th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                
                  @foreach ($regions as $region)

                    <tr>
                      <td></td>
                      <td>{{ $region->cname }}</td>
                      <td>{{ $region->name }}</td>
                      <td>{{ $region->name_arabic }}</td>
                     <td>
                        <a href="{{ route('region.edit',$region->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('region.delete',$region->id)}}" class="btn btn-danger">Delete</a>
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
  