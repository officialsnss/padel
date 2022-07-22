
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
                    <th>Club Name</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                
                    <tr>
                      <td></td>
                      <td>{{ $club->name }}</td>
                     
                     
                     <td><a href="{{ route('club.edit', $club->id )}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('club.images', $club->id )}}" class="btn btn-warning">Upload Images</a>
                       
                      
                      
                       
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
  