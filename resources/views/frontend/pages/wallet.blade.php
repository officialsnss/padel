@extends('frontend.layouts.app')

@section('content')
<div class="mid-area-wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="text-center mb-lg-5 mb-md-5 mb-sm-5 mb-3">Wallet</h1>
			</div>
			<div class="col-lg-6 col-md-8 col-sm-10 offset-lg-3 offset-md-2 offset-sm-1">
				<div class="form-box">
					@foreach ($data as $row )
					<div class="row wallet-row">
						<div class="col-2">
						@if($row['status'] == 1)
							<span class="wallet-arrow"><img src="images/arrow-up.svg" class="h-100" alt="down"></span>
						@else
							<span class="wallet-arrow"><img src="images/arrow-down.svg" class="h-100" alt="down"></span>
						@endif
						</div>
						<div class="col-6 col-lg-7 col-md-7 col-sm-6">
							<div class="wallet-balance">
								<h3>{{$row['amount']}} KWD</h3>
							@if($row['status'] == 1)
								<p>Refund -Booking {{$row['booking_id']}}</p>
							@else
								<p>Booking {{$row['booking_id']}}</p>
							@endif	
							</div>
						</div>
						<div class="col-4 col-lg-2 col-md-3 col-sm-4">
							<div class="wallet-date">12/02/2022</div>
						</div>
					</div>
					@endforeach


				</div>

		</div>
		</div>
		</div>
		</div>
		@endsection