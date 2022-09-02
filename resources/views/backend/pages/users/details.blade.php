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
                <td><strong>Whatapp No</strong></td>
                <td>{{ ($userInfo->whatsapp_no)?$userInfo->whatsapp_no:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Instagram URL</strong></td>
                <td>{{ ($userInfo->instagram_url)?$userInfo->instagram_url:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Match Played</strong></td>
                <td>{{ ($userInfo->match_played)?$userInfo->match_played:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Match Won</strong></td>
                <td>{{ ($userInfo->match_won)?$userInfo->match_won:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Match Lose</strong></td>
                <td>{{ ($userInfo->match_loose)?$userInfo->match_loose:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Followers</strong></td>
                <td>{{ ($userInfo->followers)?$userInfo->followers:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Following</strong></td>
                <td>{{ ($userInfo->following)?$userInfo->following:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Levels</strong></td>
                <?php $levelName = \App\Models\Levels::where(['id' => $userInfo->levels])->pluck('name')->first(); ?>
                <td>{{ ($levelName)?$levelName:'-' }}</td>
               </tr>
               <tr>
                <td><strong>Which Side Prefer</strong></td>
                <td>@if($userInfo->court_side == '1')
                     {{'Side A'}}
                  @elseif($userInfo->court_side == '2')
                  {{'Side B'}}
                  @else{{'-'}}
                  @endif</td>
               </tr>
               <tr>
                <td><strong>Play Time</strong></td>
                <td>@if($userInfo->play_time == '1')
                     {{'Morning'}}
                    @elseif($userInfo->play_time == '2')
                     {{'Evening'}}
                    @else
                    {{'Night'}}
                    @endif</td>
               </tr>
               <tr>
                <td><strong>Best Shot</strong></td>
                <td>@if($userInfo->best_shot == '1')
                     {{'Shot A'}}
                    @elseif($userInfo->play_time == '2')
                     {{'Shot B'}}
                    @elseif($userInfo->play_time == '3')
                    {{ 'Shot C'}}
                    @else
                    {{'-'}}
                    @endif</td>
               </tr>
               <tr>
                <td><strong>Gender</strong></td>
                <td>@if($userInfo->gender == '1')
                     {{'Female'}}
                    @elseif($userInfo->play_time == '2')
                     {{'Male'}}
                    @elseif($userInfo->play_time == '3')
                     {{'Other'}}
                    @else
                    {{ '-'}}
                    @endif</td>
               </tr>
               <tr>
                <td><strong>Created At</strong></td>
                <td>{{ $userInfo->created_at}}</td>
               </tr>
               <tr>
                <td><strong>Updated At</strong></td>
                <td>{{ $userInfo->updated_at}}</td>
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
                  <a href="{{ route('customers') }}" class="btn btn-info">BACK</a>
                </div>
                </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
        @endsection