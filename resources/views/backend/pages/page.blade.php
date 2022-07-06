
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('page.create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Page Title</th>
                    <th>Content</th>
                    
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($pages as $page)
                    <tr>
                      <td></td>
                      <td>{{ $page->title }}</td>
                     
                      <td>{{ str_replace("&nbsp;", "", substr(strip_tags($page->content),0, 100)) }} ...</td>
                     
                     @if($page->status === '1')
                        <td >Active</td>
                      @else
                        <td>Inactive</td>
                       @endif 
                       
                       <td><a href="{{ route('page.view',$page->id)}}" class="btn btn-success">View</a>
                        <a href="{{ route('page.edit',$page->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('page.delete',$page->id)}}" class="btn btn-danger">Delete</a>
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
  