@extends('Master')
@section('Judul','Log In')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<section id="contact-page" class="container">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form" style="text-align:center; margin:auto;"><!--login form-->
						<h2>Login To Your Account</h2>
						<form method="POST" action="Login">
							@foreach ($errors->all() as $error)
								 <p class="alert alert-danger">{{ $error }}</p>
							@endforeach
							@if (session('status'))
							   <div class="alert alert-success">
							       {{ session('status') }}
							   </div>
							@endif
							<input type="text" required name="Email" placeholder="Email" />
							<input type="password" required name="Password" placeholder="Password" />
							<div class="form-group" style="text-align:center;">
								  <div class="col-md-6">
										<a href="{{ url('/RegisterCustomer')}}"><input type="button" class="btn btn-info" value="Register" style="border-radius:5px; color:black; hover:black;"></a>
								  </div>
								  <div class="col-md-6">
										 <input type="submit" id="BtnCreatePembeli" name="BtnCreatePembeli" value="Log In" class="btn btn-success">
								  </div>
						  </div>
						</form>
					</div>
					<br><br><br>
				</div>
			</div>
	</section>
@endsection
