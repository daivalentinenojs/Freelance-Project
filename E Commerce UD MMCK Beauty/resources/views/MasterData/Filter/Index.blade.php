@extends('Masters')
@section('Judul','Home | MMC Shopper')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<br>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
			</div>
			<div class="col-sm-4">
				<form class="" name="FormSort" id="FormSort" action="{{ url('/SortProduct')}}" method="POST">
						@if($KodeFilter != '')
								<input type="hidden" name="KodeFilter" id="KodeFilter" value="{{$KodeFilter}}">
						@else
								<input type="hidden" name="KodeFilter" id="KodeFilter" value="">
						@endif
						<input type="hidden" name="IDFilter" id="IDFilter" value="{{$IDFilter}}">
						<input type="hidden" name="IDSorting" id="IDSorting" value="{{$IDSort}}">
						@if($Keyword != '')
							<input type="hidden" name="Keyword" id="Keyword" value="{{$Keyword}}">
						@else
							<input type="hidden" name="Keyword" id="Keyword" value="">
						@endif
						<div class="form-group">
									<label class="col-md-3 control-label" style="text-align:center; margin-top:8px;">Sort By</label>
									<div class="col-md-9">
											 <select name="IDSort" id="IDSort" required class="form-control select" data-live-search="true">
												 @if($IDSort == 1)
													 <option selected value="1">New Arrival</option>
												 @else
												 	 <option value="1">New Arrival</option>
												 @endif

												 @if($IDSort == 2)
													 <option selected value="2">Price (Low To High)</option>
												 @else
												 	 <option value="2">Price (Low To High)</option>
												 @endif

												 @if($IDSort == 3)
													 <option selected value="3">Price (High To Low)</option>
												 @else
												 	 <option value="3">Price (High To Low)</option>
												 @endif

												 @if($IDSort == 4)
													 <option selected value="4">Product (A To Z)</option>
												 @else
												 	 <option value="4">Product (A To Z)</option>
												 @endif

												 @if($IDSort == 5)
													 <option selected value="5">Product (Z To A)</option>
												 @else
												 	 <option value="5">Product (Z To A)</option>
												 @endif
											 </select><br>
									</div>
						</div>
				</form>
			</div>
		</div>
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
					@if($KodeFilter == 'XB')
						<h2 class="title text-center">{{$NamaX[0]['BrandName']}}</h2>
					@elseif($KodeFilter == 'XC')
						<h2 class="title text-center">{{$NamaX[0]['CategoryName']}}</h2>
					@elseif($KodeFilter == 'XS')
							<h2 class="title text-center">{{$NamaX[0]['Nama']}}</h2>
					@else
							<h2 class="title text-center"><a href="{{ route('SaleFilter')}}" style="color:#474141;">Product Sale</a></h2>
					@endif

					@foreach ($Data as $Sale)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products" style="height:500px;">
									<div class="productinfo text-center">
										<?php $TempID = $Sale->ID; ?>
										<?php $TempIDS = $Sale->ID; ?>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><img src="{{asset('foto/barang/'.$TempID.'.jpg')}}" alt="" /></a>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:15px;"><b>{{$Sale->NamaMerk}}</b></p></a>
										<a href="{{ route('ProductInformation',$TempIDS)}}"><p style="font-size:17px; color:#f5e153; margin-top:-5px;"><b>{{$Sale->Nama}}</b></p></a>
										@if($Sale->Promo == 1)
											<h2 style="text-decoration: line-through; font-size:12px; margin-top:-5px;">IDR {{number_format($Sale->HargaJual,0,",",".")}}</h2>
											<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($Sale->HargaJualPromo,0,",",".")}}</h2>
										@else
											<h2 style="font-size:15px; margin-top:-5px;">IDR {{number_format($Sale->HargaJual,0,",",".")}}</h2>
										@endif

										@if(Auth::check())
												@if($Role == 0 && $Sale->Stok > 0)
													<button type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$Sale->ID}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												@endif
										@else
												<a href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										@endif
									</div>
							</div>
						</div>
						@if($Sale->Stok == 0)
						<div>
							<img src="{{url('images/home/stock.png')}}" class="new" alt="">
						</div>
						@elseif($Sale->Promo == 1)
						<div>
							<img src="{{url('images/home/sale.png')}}" class="new" alt="">
						</div>
						@endif
					</div>
				@endforeach
		</div><!--features_items-->
	</div>
	<ul class="pagination pagination-sm pull-right push-down-20 push-up-20">
			<?php
			echo $Data->render();
			?>
	</ul>
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
						//  alertify.alert("Information", function(){
						// 		 alertify.message('Product has been add to chart !');
						//  });
        });
    });
});

$(function(){
   $(document).on('change','#IDSort',function(e){
		 	$('#FormSort').submit();
   });
});
</script>
@endsection
