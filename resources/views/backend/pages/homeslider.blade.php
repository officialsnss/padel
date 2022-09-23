
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('slide.create') }}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Image</th>
                    <th>Heading</th>
                    <th>Button Label</th>
                    <th>Button URL</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($slides as $slide)
                    <tr>
                      <td></td>
                      <td>{{ $slide->heading }}</td>
                      <td><div id="image-holder"> 
                         @if($slide->image)
                            <img src="{{ URL::to('/') }}/Images/homeslider_images/{{ $slide->image }}" class="thumb-image-list">
                         @endif
                         </div></td>
                      <td>{{ $slide->button_label }}</td>
                      <td>{{ $slide->button_url }}</td>
                       <td>
                        <a href="{{ route('slide.edit', $slide->id) }}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('slide.delete', $slide->id) }}" class="btn btn-danger">Delete</a>
                      
                       
                       
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
  