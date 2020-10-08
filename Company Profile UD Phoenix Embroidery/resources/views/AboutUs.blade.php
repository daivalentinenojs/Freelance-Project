@extends('Masters')
@section('Judul','About Us')
@section('Navigasi')
   @include('Navigasi/Navigasi')
@endsection

@section('Slider')
<div id="contact-page" class="container">
	<div class="bg">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
			<h2 class="title text-center">About <strong>Us</strong></h2>
			<div class="form-group" style="text-align:center">
						<p style='font-family:"Britanic_Bold";'><b>
							<?php
									$AboutEnglish = $Content[0]['Content'];
									$ArrayNama = explode(" ",$AboutEnglish);
									$HurufAwalEnglish = $ArrayNama[0][0];
									$ParagrafEnglish = substr($AboutEnglish,1);
									echo '<b style="font-size:50px; font-family:Forte; color:orange;">'.$HurufAwalEnglish.'</b>'.$ParagrafEnglish;
							?>
						</b></p><br>
			 </div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
		<h2 class="title text-center">Tentang <strong>Kami</strong></h2>
		<div class="form-group" style="text-align:center">
					<p style='font-family:"Britanic_Bold";'><b>
						<?php
							$AboutInd = $Content[0]['ContentIndonesia'];
							$ArrayNamaInd = explode(" ",$AboutInd);
							$HurufAwalInd = $ArrayNamaInd[0][0];
							$ParagrafInd = substr($AboutInd,1);
							echo '<b style="font-size:50px; font-family:Forte; color:orange;">'.$HurufAwalInd.'</b>'.$ParagrafInd;
						?>
					</b></p><br>
		 </div>
	</div>
</div>
		<div class="bg">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
				<h2 class="title text-center">Our <strong>Office</strong></h2>
				<div class="form-group" style="text-align:center">
							 <img width="550px" height="300px" src="foto/map/map.jpg"><br><br>
				 </div>
			</div>
		</div>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<div class="contact-info">
						<h2 class="title text-center">Contact Info</h2>
						<address>
							<p><?php echo $Content[0]['CompanyName']; ?></p>
							<p><?php echo $Content[0]['Address']; ?></p>
							<p><?php echo $Content[0]['City']; ?></p>
							<p><?php echo $Content[0]['Phone']; ?></p>
							<p><?php echo $Content[0]['Email']; ?></p>
						</address>
						<div class="social-networks">
							<h2 class="title text-center">Social Networking</h2>
							<p style='font-family:"Britanic_Bold";'><b><?php echo $Content[0]['Home']; ?></b></p><br>
							<p style='font-family:"Britanic_Bold";'><b><?php echo $Content[0]['HomeIndonesia']; ?></b></p><br>
							<ul>
								<li>
									<a target="_blank" href="{{url('http://instagram.com/phoenixembroiderysurabaya')}}"><i class="fa fa-instagram"></i></a>
								</li>
							</ul>
						</div>
						<br>						
					</div>
				</div>
			</div>
		</div>
	</div><!--/#contact-page-->
@endsection
