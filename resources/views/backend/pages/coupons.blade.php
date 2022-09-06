
@extends('backend.layouts.app')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="add">
                 <a href="{{ route('coupon.create')}}" class="btn btn-info">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Minimum Amount</th>
                    <th>No of Users Used</th>
                    <th>No of Times</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  @foreach ($coupons as $coupon)
                    <tr>
                      <td></td>
                      <td>{{ $coupon->name }}</td>
                      <td>{{ $coupon->code }}</td>
                      <td>{{ ($coupon->discount_type == 1)?'Fixed':'Discount' }}</td>
                      <td>{{ $coupon->amount }} {{ $coupon->ccode }}</td>
                      <td>{{ $coupon->minimum_amount }} {{ $coupon->ccode }}</td>
                      <td>{{ $coupon->no_of_users_used }}</td>
                      <td>{{ $coupon->no_of_times }}</td>
                      <td>{{ ($coupon->status == 1)?'Active':'Inactive' }}</td>
                       <td>
                      <a href="{{ route('coupon.edit', $coupon->id)}}" class="btn btn-secondary">Edit</a>
                      <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn {{ ($coupon->status == 1)?'btn-danger':'btn-success' }}">{{ ($coupon->status == 1)?'Deactivate':'Activate' }}</a>
                       </td>
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
  