@extends('Master')
@section('Judul','Product')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Isi')
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/Fashion')}}">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/HomeDecoration')}}">Home Decoration</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/Embroidery')}}">3D Embroidery</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/Souvenir')}}">Souvenir</a></h4>
								</div>
							</div>
						</div><!--/category-productsr-->
					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Description</h2>
						<div class="col-sm-12">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<p><br><strong><?php echo $DataCategory[0]['Description'];?></strong></p>
									</div>
								</div>
							</div>
						</div>
					</div><!--features_items-->

					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Deskripsi</h2>
						<div class="col-sm-12">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<p><br><strong><?php echo $DataCategory[0]['DeskripsiIndonesia'];?></strong></p>
									</div>
								</div>
							</div>
						</div>
					</div><!--features_items-->
				</div>


				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						@foreach ($ItemCategory as $Item)
						<?php
						echo '<a class="gallery-item" href="foto/product/'.$Item['IDProduct'].'.jpg" data-gallery>';
						 ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?php
                       if ($Item['ProductFormat'] == 0) {
                              echo '<img width="150px" height="300px" src="foto/product/'.$Item['IDProduct'].'.jpg"><br><br>';
                      } else {
                             echo '<video  width="320" height="240" src="foto/product/'.$Item['IDProduct'].'.mp4" controls autoplay></video>';
                      }
                       ?>
											 <p><br><strong><?php echo $Item['ProductName'];?></strong> (<strong><?php echo $Item['NamaIndonesia'];?></strong>)</p>
 									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<p><strong><?php echo $Item['ProductName'];?></strong> (<strong><?php echo $Item['NamaIndonesia'];?></strong>)</p>
											<p style="margin:5px;"><?php echo $Item['Description'];?></p>
											<p style="margin:5px;"><?php echo $Item['DeskripsiIndonesia'];?></p>
										</div>
									</div>
								</div>
							</div>
						</div>	</a>
						@endforeach
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
@endsection

@section('Script')
<script type="text/javascript">

</script>
@endsection
