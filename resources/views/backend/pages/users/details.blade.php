@extends('backend.layouts.app')
@section('content')
<div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $userInfo->name }} Details</h3>
         </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
             
            <table class="details">
               <tr>
                <td><strong>Full Name</strong></td>
                <td>{{ $userInfo->name }}</td>
               </tr>
               <tr>
                <td><strong>Email</strong></td>
                <td>{{ $userInfo->email }}</td>
               </tr>
               <tr>
                <td><strong>Phone</strong></td>
                <td>{{ $userInfo->phone }}</td>
               </tr>
               <tr>
               
               </tr>
              
               <tr>
                <td><strong>User Notification</strong></td>
                @if($userInfo->notification === '1')
                        <td >ON</td>
                      @else
                        <td>OFF</td>
                       @endif
                       
               </tr>
               <tr>
                <td><strong>Wallets</strong></td>
                <td><a href="{{ route('wallets', $userInfo->id) }}" class="btn btn-success">View Wallets</a></td>
                </tr>
            </table>
                <div class="bk-btn">
                  <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                </div>
                </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
        @endsection