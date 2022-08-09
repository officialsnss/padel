@extends('backend.layouts.app')
@section('content')
<div class="card">
      
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <table class="details">
                  <tr>
                    <td><strong>Full Name</strong></td>
                    <td>{{ $contactInfo->name }}</td>
                  </tr>
                  <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $contactInfo->email }}</td>
                  </tr>
                  <tr>
                    <td><strong>Phone</strong></td>
                    <td>{{ $contactInfo->phone }}</td>
                  </tr>
                  <tr>
                    <td><strong>Message</strong></td>
                    <td>{{ $contactInfo->message }}<br>
                   </td>
                  </tr>
                  <tr>
                    <td><strong>Date-Time</strong></td>
                    <td>{{ $contactInfo->send_time }}<br>
                   </td>
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