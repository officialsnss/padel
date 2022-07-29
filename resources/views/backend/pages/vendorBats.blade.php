
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Bat Name</th>
                    <th>Price(per hour)</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($bats as $bat)
                    <tr>
                      <td></td>
                      <td>{{ $bat->name }}</td>
                      <td>{{ $bat->price }} {{ $bat->code }}</td>
                      <td>{{ $bat->quantity }}</td>
                     
                    
                       
                       <td> <a href="" class="btn btn-secondary">Edit</a>
                      
                       
                       
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
  