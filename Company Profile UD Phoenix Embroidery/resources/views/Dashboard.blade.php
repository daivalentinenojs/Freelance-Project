@extends('Masters')
@section('Judul','Home')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Slider')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="item">
				</div>
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-4">
								<!-- <h1><span>E</span>-SHOPPER</h1> -->
								<!-- <h2>Free E-Commerce Template</h2> -->
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->
								<!-- <button type="button" class="btn btn-default get">Get it now</button> -->
							</div>
							<div class="col-sm-11">
								<img width="3000px;" height="2000px;" src="{{url('foto/slider/1.jpg')}}" class="girl img-responsive" alt="" />
								<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
							</div>
						</div>
						<div class="item">
							<div class="col-sm-4">
								<!-- <h1><span>E</span>-SHOPPER</h1> -->
								<!-- <h2>100% Responsive Design</h2> -->
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->
								<!-- <button type="button" class="btn btn-default get">Get it now</button> -->
							</div>
							<div class="col-sm-3">
								<img width="5000px;" height="2000px;" src="{{url('foto/slider/2.jpg')}}" class="girl img-responsive" alt="" />
								<!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
							</div>
						</div>

						<div class="item">
							<div class="col-sm-4">
								<!-- <h1><span>E</span>-SHOPPER</h1> -->
								<!-- <h2>Free Ecommerce Template</h2> -->
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> -->
								<!-- <button type="button" class="btn btn-default get">Get it now</button> -->
							</div>
							<div class="col-sm-3">
								<img width="5000px;" height="2000px;" src="{{url('foto/slider/3.jpg')}}" class="girl img-responsive" alt="" />
								<!-- <img src="images/home/pricing.png" class="pricing" alt="" /> -->
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				<br><br>
			</div>
		</div>
	</div>
@endsection
