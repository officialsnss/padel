@extends('frontend.layouts.app')

@section('content')
<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 profile-form-col">
					<div class="form-box">
						<h2>Pofile</h2>
						<div class="form-control-group">
							<select class="form-control"><option>-- Gender --</option><option>Male</option><option>Female</option></select>
						</div>
						<div class="form-control-group"><input class="form-control" placeholder="Instagram" /></div>
						<div class="form-control-group"><input class="form-control" placeholder="Whatsapp no" /></div>
						<div class="form-control-group"><input class="form-control" placeholder="Date of Birth" /></div>
						<h2>What Times do you play</h2>
						<div class="form-control-group">
							<select class="form-control"><option>-- Prefer Time --</option><option>Morning</option><option>Evening </option><option>Night</option></select>
						</div>
						<h2>Best Shot</h2>
						<div class="form-control-group">
							<select class="form-control"><option>-- Select Shot --</option><option>A</option><option>B</option><option>C</option></select>
						</div>
						<h2>Level you Played</h2>
						<div class="form-control-group">
							<select class="form-control"><option>-- Select Shot --</option><option>A</option><option>B</option><option>C</option></select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 profile-form-col">
					<div class="form-box">
						<h2>Which side you prefer</h2>
						<div class="form-control-group">
							<select class="form-control"><option>-- Prefer Side --</option><option>A</option><option>B</option></select>
						</div>
						<div class="form-control-group padel-court"><img src="images/padel-court-3d-rendering-paddle-tennis-court.png" class="w-100" alt="" /></div>
						<div class="form-control-group"><button class="btn button w-100 pt-3 pb-3" onClick="location.href='/profile'">Submit</button></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection