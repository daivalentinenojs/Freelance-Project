@extends('Masters')
@section('Judul','Home | MMC Shopper')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<br>
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($SlideShow as $Slide)
							<li data-target="#slider-carousel" data-slide-to="{{$Slide['ID']}}"></li>
						@endforeach
					</ol>

					<div class="carousel-inner">
						<?php $Index = 1; ?>
						@foreach($SlideShow as $Slide)
							@if($Index == $Slide['ID'])
								<div class="item active">
							@else
								<div class="item">
							@endif
							<div class="col-sm-6">
								<h1 style="font-family:'Broadway';"><span>{{$Slide['SliderName']}}</span></h1>
								<h2 style="font-family:'Arial';">{{$Slide['Title']}}</h2>
								<p style="font-family:'Minion Pro Cond'; margin-top:-10px;">{{$Slide['Description']}}</p>
							</div>
							<div class="col-sm-6">
								<img src="foto/slider/{{$Slide['ID']}}.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
						@endforeach

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section><!--/slider-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div style="background:#f2e5ac;" class="panel-group category-products" id="accordian"><!--category-productsr-->
						@foreach($DataCategory as $Category)
						<?php $TempIDC = $Category['ID']; ?>
						<div class="panel panel-default">
							<div style="background:#f2e5ac;" class="panel-heading">
								<h4 style="background:#f2e5ac;" class="panel-title"><a href="{{ route('CategoryFilter',$TempIDC)}}">{{$Category['CategoryName']}}</a></h4>
							</div>
						</div>
						@endforeach
						<div class="panel panel-default">
							<div style="background:#f2e5ac;" class="panel-heading">
								<h4 style="background:#f2e5ac;" class="panel-title"><a href="{{ route('SaleFilter')}}">Sale</a></h4>
							</div>
						</div>
					</div><!--/category-products-->

					<div class="brands_products"><!--brands_products-->
						<h2>Brands</h2>
						<div style="background:#f2e5ac;" class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								@foreach($DataBrand as $Brand)
								<?php $TempIDB = $Brand['ID'];?>
								<li><a style="background:#f2e5ac;" href="{{ route('BrandFilter',$TempIDB)}}"> <span class="pull-right">({{$Brand['Jumlah']}})</span>{{$Brand['BrandName']}}</a></li>
								@endforeach
							</ul>
						</div>
					</div><!--/brands_products-->
				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">New Arrivals</h2>
					@foreach ($ProductNew as $New)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">
										<?php $TempIDS = $New['ID']; ?>
										  <a href="{{ route('ProductInformation',$TempIDS)}}"><img src="foto/barang/{{$New['ID']}}.jpg" alt="" /></a>
											<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:15px;"><b>{{$New['NamaMerk']}}</b></p></a>
											<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:20px; color:#f5e153; margin-top:-5px;"><b>{{$New['Nama']}}</b></p></a>
											@if($New['Promo'] == 1)
												<h2 style="text-decoration: line-through; font-size:12px; margin-top:-5px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
												<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($New['HargaJualPromo'],0,",",".")}}</h2>
											@else
												<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
											@endif


										@if(Auth::check())
												@if($Role == 0)
													<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$New['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												@endif
										@else
												<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										@endif
									</div>
									<div>
										<img src="images/home/new.png" class="new" alt="">
										<!-- <div class="overlay-content">
											@if($New['Promo'] == 1)
												<h2 style="text-decoration: line-through; font-size:15px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
												<h2 style="font-size:15px;">IDR {{number_format($New['HargaJualPromo'],0,",",".")}}</h2>
											@else
												<h2 style="font-size:15px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
											@endif
											<p style="font-size:20px;"><b>{{$New['Nama']}}</b></p>
											<p>{{$New['Keterangan']}}</p>
											@if(Auth::check())
													@if($Role == 0)
														<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$New['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													@endif
											@else
													<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											@endif
										</div> -->
									</div>
							</div>
						</div>
					</div>
					@endforeach
				</div><!--features_items-->

				<div class="features_items"><!--features_items-->
					<h2 class="title text-center"><a href="{{ route('SaleFilter')}}" style="color:#474141;">Product Sale</a></h2>
					@foreach ($ProductSale as $Sale)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">
										<?php $TempIDS = $Sale['ID']; ?>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><img src="foto/barang/{{$Sale['ID']}}.jpg" alt="" /></a>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:15px;"><b>{{$New['NamaMerk']}}</b></p></a>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:17px; color:#f5e153; margin-top:-5px;"><b>{{$New['Nama']}}</b></p></a>
										@if($New['Promo'] == 1)
											<h2 style="text-decoration: line-through; font-size:12px; margin-top:-5px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
											<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($New['HargaJualPromo'],0,",",".")}}</h2>
										@else
											<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
										@endif

									  @if(Auth::check())
												@if($Role == 0)
													<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$Sale['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												@endif
										@else
												<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										@endif
									</div>
									<div>
										<img src="images/home/sale.png" class="new" alt="">
										<!-- <div class="overlay-content">
											@if($Sale['Promo'] == 1)
												<h2 style="text-decoration: line-through; font-size:15px;">IDR {{number_format($Sale['HargaJual'],0,",",".")}}</h2>
												<h2 style="font-size:15px;">IDR {{number_format($Sale['HargaJualPromo'],0,",",".")}}</h2>
											@else
												<h2 style="font-size:15px;">IDR {{number_format($Sale['HargaJual'],0,",",".")}}</h2>
											@endif
											<p style="font-size:20px;"><b>{{$Sale['Nama']}}</b></p>
											<p>{{$Sale['Keterangan']}}</p>

											@if(Auth::check())
													@if($Role == 0)
														<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$Sale['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													@endif
											@else
													<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											@endif

										</div> -->
									</div>
							</div>
						</div>
					</div>
					@endforeach
				</div><!--features_items-->

				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">Best Seller</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							@foreach($ProductRecommendedItems as $Items)
							<div class="item active">
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<?php $TempIDS = $New['ID']; ?>
												<a href="{{ route('ProductInformation',$TempIDS)}}"><img src="foto/barang/{{$Items['ID']}}.jpg" alt="" /></a>
												<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:15px;"><b>{{$New['NamaMerk']}}</b></p></a>
												<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:17px; color:#f5e153; margin-top:-5px;"><b>{{$New['Nama']}}</b></p></a>
												@if($New['Promo'] == 1)
													<h2 style="text-decoration: line-through; font-size:12px; margin-top:-5px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
													<h2 style="font-size:15px; margin-top:-10px;">IDR {{number_format($New['HargaJualPromo'],0,",",".")}}</h2>
												@else
													<h2 style="font-size:15px; margin-top:-10px;">IDR {{number_format($New['HargaJual'],0,",",".")}}</h2>
												@endif

											  @if(Auth::check())
														@if($Role == 0)
															<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$Items['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
														@endif
												@else
														<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
				</div><!--/recommended_items-->

			</div>
		</div>
	</div>
</section>
@endsection

@section('Script')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.btn-buy', function() {
           IDBarang = $(this).attr('id');
					 $.ajax({
						 		headers : {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                url: '{{ url("/AddCart") }}'+'/'+IDBarang,
                type: 'POST'
            }).done(function(data) {
								// alert('Product has been added to chart !');
								noty({text: "Product has been added to chart !", layout: 'topCenter', type: 'success'});
								location.reload();
								// alertify.alert("Information", function(){
								// 		 alertify.message('Product has been add to chart !');
								// });
            });
        });
    });
</script>
@endsection
