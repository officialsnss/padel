@extends('backend.layouts.app')
@section('content')

<div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $userInfo->name }} Details</h3>
        
                <div class="add">
                 <a href="{{ route('club.images', $userInfo->clubid)}}" class="btn btn-info">Gallery</a>
                </div>
              </div>
        
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
             
            <table class="details">
               <tr>
                <td><strong>Full Name</strong></td>
                <td>{{ $userInfo->username }}</td>
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
                <td><strong>Club Name</strong></td>
                <td>{{ $userInfo->clubname }}</td>
               </tr>
               <tr>
                <td><strong>Description</strong></td>
                <td>{{ strip_tags($userInfo->description) }}</td>
               </tr>
               <tr>
                <td><strong>Service Charge</strong></td>
                <td>{{ $userInfo->service_charge }}</td>
               </tr>
               <tr>
                <td><strong>Commission</strong></td>
                <td>{{ $userInfo->commission }} %</td>
               </tr>
               <tr>
                <td><strong>Indoor Courts</strong></td>
                <td>{{ $userInfo->indoor_courts }} </td>
               </tr>
               <tr>
                <td><strong>Outdoor Courts</strong></td>
                <td>{{ $userInfo->outdoor_courts }} </td>
               </tr>
               <tr>
                <td><strong>Price for Singles</strong></td>
                <td>{{ $userInfo->single_price }} {{ $userInfo->code }}</td>
               </tr>
               <tr>
                <td><strong>Address</strong></td>
                <td>@if($userInfo->address)
                   {{ $userInfo->address }}<br>
                   @endif
                   @if($userInfo->region)
                    {{ $userInfo->region }}<br>
                    @endif
                    @if($userInfo->city)
                    {{ $userInfo->city }}<br>
                    @endif
                    @if($userInfo->country)
                    {{ $userInfo->country }}<br>
                    @endif
                    @if($userInfo->zipcode)
                    {{ $userInfo->zipcode }}<br>
                    @endif
                  <tr>
                <td><strong>Price for Doubles</strong></td>
                <td>{{ $userInfo->double_price }} {{ $userInfo->code }}</td>
               </tr></td>
               </tr>
               <tr>
                <td><strong>Price for Doubles</strong></td>
                <td>{{ $userInfo->double_price }} {{ $userInfo->code }}</td>
               </tr>
               <tr>
                <td><strong>Latitude</strong></td>
                <td>{{ $userInfo->latitude }} </td>
               </tr>
               <tr>
                <td><strong>Longitude</strong></td>
                <td>{{ $userInfo->longitude }} </td>
               </tr>
               <tr>
                <td><strong>Amenities</strong></td>
                <td> <?php 
              
                $lists = explode(',', $amenityList);
                     ?>
                     @foreach($lists as $list)
                        @if($list != '')
                     <p>- {{ $list }} </p>
                        @endif
                    @endforeach
              </td>
               </tr>
               <tr>
                <td><strong>Featured Image</strong></td>
                <td>
                   @if($userInfo->featured_image)
                            <img src="{{ URL::to('/') }}/Images/club_images/{{ $userInfo->featured_image }}" class="thumb-image">
                         @endif</td>
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