
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('bat.create') }}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Bat Name</th>
                    <th>Arabic Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach ($bats as $bat)
                    <tr>
                      <td></td>
                      <td>{{ $bat->name }}</td>
                      <td>{{ $bat->name_arabic }}</td>
                      <!-- <td>{{ str_replace("&nbsp;", "", strip_tags($bat->description)) }}</td> -->
                      <td><div id="image-holder">
                         @if($bat->featured_image)
                            <img src="{{ URL::to('/') }}/Images/bat_images/{{ $bat->featured_image }}" class="thumb-image-list">
                         @endif
                         </div>
                        </td>
                        <td><input type="checkbox" data-id="{{ $bat->id }}" name="status" class="js-switchesss" {{ $bat->status == 1 ? 'checked' : '' }}></td>
                       <td>
                        <a href="{{ route('bat.edit',$bat->id) }}" class="btn btn-secondary">Edit</a>
                        <a href="{{ route('bat.delete',$bat->id) }}" class="btn btn-danger">Delete</a>



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
