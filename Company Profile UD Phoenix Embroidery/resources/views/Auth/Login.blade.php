@extends('Master')
@section('Judul','Log In')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<section id="contact-page" class="container"><!--form-->
				<div class="col-sm-4">
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="login-form" style="text-align:center; margin:auto;"><!--login form-->
						<h2>Login to your account</h2>
						<form method="POST" action="Auth/Login">
							<input type="text" required name="NIP" placeholder="NIP" />
							<input type="password" required name="Password" placeholder="Password" />
							<div style="text-align:center; margin:auto; width:35%;">
									<button type="submit" class="btn btn-default">Login</button>
							</div>
						</form>
					</div>
					<br><br><!--/login form-->
				</div>
			</div>
	</section><!--/form-->
@endsection
