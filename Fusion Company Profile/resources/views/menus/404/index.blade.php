@extends('layouts.event')

@section('title','Wrong URL')

@section('content')
<div class="container">
    <br><br><br><br><br><br><br>
	<div  class="error">
		<p class="p">4</p>
		<span class="dracula">			
			<div class="con">
				<div class="hair"></div>
				<div class="hair-r"></div>
				<div class="head"></div>
    		<div class="eye"></div>
    		<div class="eye eye-r"></div>
  			<div class="mouth"></div>
  			<div class="blod"></div>
  			<div class="blod blod2"></div>
			</div>
		</span>
		<p class="p">4</p>
		
		<div class="page-ms">
            <br><br><br>
            <p class="page-msg"> Oops, the page you're looking for Disappeared </p>
            <br>
			<button class="go-back"><a href="/">Home</a></button>
		</div>
</div>
	</div>

<iframe style="width:0;height:0;border:0; border:none;" scrolling="no" frameborder="no" allow="autoplay" src="https://instaud.io/_/2Vvu.mp3"></iframe>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/404.css')}}" />
@endpush

@push('script')
<script type="text/javascript" src="{{asset('assets/js/404.js')}}"></script>
@endpush