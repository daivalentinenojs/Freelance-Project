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
					<h2 class="title text-center">Product Information</h2>
					<div class="panel-body">
							 <div class="col-md-4">
								 <div class="form-group">
											 <label class="col-md-4 control-label">
												 <?php $TempID = $DataProduct[0]['ID']; ?>
												 <img style="width:250px; height:250px;" id="myImg" src="{{asset('foto/barang/'.$TempID.'.jpg')}}" alt="" />
											 </label>
								 </div>
							 </div>
							 <div class="col-md-8">
									 <div class="form-group">
											<div class="col-md-12">
												 <?php $TempBrand = $DataProduct[0]['IDMerk'] ?>
												 <p style="font-size:15px; color:#4a4747;"><a style="font-size:15px; color:#4a4747;" href="{{ route('BrandFilter',$TempBrand)}}">{{$DataProduct[0]['NamaMerk']}}</a></p>
											</div>
									 </div>
									 <div class="form-group">
											 <div class="col-md-12">
												 <p style="font-size:25px; margin-top: -5px; color:#f5e153; "><b>{{$DataProduct[0]['Nama']}}</b></p>
											 </div>
									 </div>
									 <div class="form-group">
											<div class="col-md-12">
												 @if($DataProduct[0]['Promo'] == 1)<p style="text-decoration: line-through; font-size:15px; margin-left:-4px; margin-top: -15px;">IDR {{number_format($DataProduct[0]['HargaJual'],0,",",".")}}</p>
												 <p style="font-size:20px; margin-left:-4px; margin-top: -5px;">IDR {{number_format($DataProduct[0]['HargaJualPromo'],0,",",".")}}</p>
												 @else
												 <p style="font-size:30px; margin-left:-4px; margin-top: -5px;">IDR {{number_format($DataProduct[0]['HargaJual'],0,",",".")}}</p>
												 @endif
											</div>
									 </div>
									 <div class="form-group">
											 <label class="col-md-2 control-label" style="font-size:15px; margin-left:-4px; margin-top: -10px; font-family:'Britannic_Bold'">Stock :</label>
 											<div class="col-md-8">
 												 <p style="font-size:15px; margin-left:-4px; margin-top: -10px; font-family:'Britannic_Bold'">{{$DataProduct[0]['Stok']}}</p>
 											</div>
									 </div>
									 <div class="form-group">
										 <div class="col-md-6"><br>
											 @if(Auth::check())
													 @if($Role == 0)
														 <button style="margin-left:-4px; margin-top: -15px;" type="submit" class="btn-buy btn btn btn-default add-to-cart" id="{{$DataProduct[0]['ID']}}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
													 @endif
											 @else
													 <a style="margin-left:-4px; margin-top: -15px;" href="{{ url('/Logins')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											 @endif
									 	  </div>
									 </div>
									 <div class="form-group">
											<div class="col-md-12">
												 <p style="margin-left:-4px; margin-top: -10px; font-family:'Britannic_Bold'">{{$DataProduct[0]['Keterangan']}}</p>
											</div>
									 </div>
							 </div>
					</div>
				</div><!--features_items-->
	</div>
</section><br><br>

<!-- The Modal -->
<div id="myModal" class="modal closes">

  <!-- The Close Button -->
  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

<style media="screen">
/* Style the Image Used to Trigger the Modal */
#myImg {
	border-radius: 5px;
	cursor: pointer;
	transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 3; /* Sit on top */
	padding-top: 100px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
	margin: auto;
	display: block;
	width: 80%;
	max-width: 400px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
	margin: auto;
	display: block;
	width: 80%;
	max-width: 700px;
	text-align: center;
	color: #ccc;
	padding: 10px 0;
	height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
	-webkit-animation-name: zoom;
	-webkit-animation-duration: 0.6s;
	animation-name: zoom;
	animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
	from {-webkit-transform:scale(0)}
	to {-webkit-transform:scale(1)}
}

@keyframes zoom {
	from {transform:scale(0)}
	to {transform:scale(1)}
}

/* The Close Button */
.close {
	position: absolute;
	top: 15px;
	right: 35px;
	color: #f1f1f1;
	font-size: 40px;
	font-weight: bold;
	transition: 0.3s;
}

.close:hover,
.close:focus {
	color: #bbb;
	text-decoration: none;
	cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
	.modal-content {
			width: 100%;
	}
}
</style>
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

// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");


img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var spans = document.getElementsByClassName("closes")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

spans.onclick = function() {
  modal.style.display = "none";
}
</script>
@endsection
