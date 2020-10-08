<?php
 require '../connection/Init.php';
 $MySQLi = mysqli_connect($domain, $username, $password, $database);

 $QueryGetDataCategory = "SELECT Kategori.ID AS 'ID', Kategori.Nama AS 'NamaCategory' FROM Kategori WHERE Kategori.IsActive = '1'";
 $HasilQueryGetDataCategory = mysqli_query($MySQLi, $QueryGetDataCategory);
 $DataCategory = array();
 while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataCategory)) {
   $DataCategory[] = $Hasil;
 }
?>
<ul class="nav navbar-nav collapse navbar-collapse">
   <li><a href="{{ url('/')}}" {{{ (Request::is('/') ? 'class=active' : '')}}}>New Arrivals</a></li>

   @foreach($DataCategory as $Category)
   <?php
      $IDTemp = $Category['ID'];
      $QueryGetDataSubCategory = "SELECT SubKategori.ID AS 'ID', SubKategori.Nama AS 'NamaSubCategory' FROM SubKategori WHERE SubKategori.IDKategori = '$IDTemp' AND SubKategori.IsActive = '1'";
      $HasilQueryGetDataSubCategory = mysqli_query($MySQLi, $QueryGetDataSubCategory);
      $DataSubCategory = array();
      while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSubCategory)) {
        $DataSubCategory[] = $Hasil;
      }
   ?>
   <?php $TempIDC = $Category['ID']; ?>
   <li class="dropdown"><a href="{{ route('CategoryFilter',$TempIDC)}}">{{$Category['NamaCategory']}}<i class="fa fa-angle-down"></i></a>
      <ul role="menu" class="sub-menu">
            @foreach($DataSubCategory as $SubCategory)
            <?php $TempIDS = $SubCategory['ID']; ?>
            <li><a href="{{ route('SubCategoryFilter',$TempIDS)}}" {{{ (Request::is('ProductFilter/1') ? 'class=active' : '')}}}>{{$SubCategory['NamaSubCategory']}}</a></li>
            @endforeach
      </ul>
   </li>
   @endforeach

   <!-- <li class="dropdown"><a href="#" {{{ (
      Request::is('ProductFilter/1') ||
      Request::is('ProductFilter/2') ||
      Request::is('ProductFilter/3') ||
      Request::is('ProductFilter/4') ||
      Request::is('ProductFilter/5') ||
      Request::is('ProductFilter/6') ||
      Request::is('ProductFilter/7') ||
      Request::is('ProductFilter/8') ||
      Request::is('ProductFilter/9') ||
      Request::is('ProductFilter/10')? 'class=active' : '')}}}>Eyes<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/ProductFilter/1')}}" {{{ (Request::is('ProductFilter/1') ? 'class=active' : '')}}}>Brow</a></li>
               <li><a href="{{ url('/ProductFilter/2')}}" {{{ (Request::is('ProductFilter/2') ? 'class=active' : '')}}}>Eye Primer</a></li>
               <li><a href="{{ url('/ProductFilter/3')}}" {{{ (Request::is('ProductFilter/3') ? 'class=active' : '')}}}>Eyeshadow</a></li>
               <li><a href="{{ url('/ProductFilter/4')}}" {{{ (Request::is('ProductFilter/4') ? 'class=active' : '')}}}>Eyeliner</a></li>
               <li><a href="{{ url('/ProductFilter/5')}}" {{{ (Request::is('ProductFilter/5') ? 'class=active' : '')}}}>Mascara</a></li>
               <li><a href="{{ url('/ProductFilter/6')}}" {{{ (Request::is('ProductFilter/6') ? 'class=active' : '')}}}>Eyelid Tape</a></li>
               <li><a href="{{ url('/ProductFilter/7')}}" {{{ (Request::is('ProductFilter/7') ? 'class=active' : '')}}}>Eyelash Adhesive</a></li>
               <li><a href="{{ url('/ProductFilter/8')}}" {{{ (Request::is('ProductFilter/8') ? 'class=active' : '')}}}>Eyelash (Premium)</a></li>
               <li><a href="{{ url('/ProductFilter/9')}}" {{{ (Request::is('ProductFilter/9') ? 'class=active' : '')}}}>Tweezers</a></li>
               <li><a href="{{ url('/ProductFilter/10')}}" {{{ (Request::is('ProductFilter/10') ? 'class=active' : '')}}}>Eyelash Curler</a></li>
         </ul>
   </li>

   <li class="dropdown"><a href="#" {{{ (
      Request::is('ProductFilter/11') ||
      Request::is('ProductFilter/12')? 'class=active' : '')}}}>Lips<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/ProductFilter/11')}}" {{{ (Request::is('ProductFilter/11') ? 'class=active' : '')}}}>Lipstick / Gloss / Lip Liner</a></li>
               <li><a href="{{ url('/ProductFilter/12')}}" {{{ (Request::is('ProductFilter/12') ? 'class=active' : '')}}}>Lip Care</a></li>
         </ul>
   </li>

   <li class="dropdown"><a href="#" {{{ (
      Request::is('ProductFilter/13') ||
      Request::is('ProductFilter/14') ||
      Request::is('ProductFilter/15') ||
      Request::is('ProductFilter/16') ||
      Request::is('ProductFilter/17') ||
      Request::is('ProductFilter/18') ||
      Request::is('ProductFilter/19') ||
      Request::is('ProductFilter/20') ||
      Request::is('ProductFilter/21')? 'class=active' : '')}}}>Face<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/ProductFilter/13')}}" {{{ (Request::is('ProductFilter/13') ? 'class=active' : '')}}}>Face Primer</a></li>
               <li><a href="{{ url('/ProductFilter/14')}}" {{{ (Request::is('ProductFilter/14') ? 'class=active' : '')}}}>Concealer</a></li>
               <li><a href="{{ url('/ProductFilter/15')}}" {{{ (Request::is('ProductFilter/15') ? 'class=active' : '')}}}>Foundation</a></li>
               <li><a href="{{ url('/ProductFilter/16')}}" {{{ (Request::is('ProductFilter/16') ? 'class=active' : '')}}}>Powder</a></li>
               <li><a href="{{ url('/ProductFilter/17')}}" {{{ (Request::is('ProductFilter/17') ? 'class=active' : '')}}}>Highlighter</a></li>
               <li><a href="{{ url('/ProductFilter/18')}}" {{{ (Request::is('ProductFilter/18') ? 'class=active' : '')}}}>Blush On</a></li>
               <li><a href="{{ url('/ProductFilter/19')}}" {{{ (Request::is('ProductFilter/19') ? 'class=active' : '')}}}>Bronzer</a></li>
               <li><a href="{{ url('/ProductFilter/20')}}" {{{ (Request::is('ProductFilter/20') ? 'class=active' : '')}}}>Contour</a></li>
               <li><a href="{{ url('/ProductFilter/21')}}" {{{ (Request::is('ProductFilter/21') ? 'class=active' : '')}}}>Setting Spray</a></li>
         </ul>
   </li>

   <li class="dropdown"><a href="#" {{{ (
      Request::is('ProductFilter/22') ||
      Request::is('ProductFilter/23') ||
      Request::is('ProductFilter/24') ||
      Request::is('ProductFilter/25') ||
      Request::is('ProductFilter/26') ||
      Request::is('ProductFilter/27')? 'class=active' : '')}}}>Beauty And Scin Care<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/ProductFilter/22')}}" {{{ (Request::is('ProductFilter/22') ? 'class=active' : '')}}}>Nail Art And Care</a></li>
               <li><a href="{{ url('/ProductFilter/23')}}" {{{ (Request::is('ProductFilter/23') ? 'class=active' : '')}}}>Face / Skin Care</a></li>
               <li><a href="{{ url('/ProductFilter/24')}}" {{{ (Request::is('ProductFilter/24') ? 'class=active' : '')}}}>Foot Care</a></li>
               <li><a href="{{ url('/ProductFilter/25')}}" {{{ (Request::is('ProductFilter/25') ? 'class=active' : '')}}}>Body Care</a></li>
               <li><a href="{{ url('/ProductFilter/26')}}" {{{ (Request::is('ProductFilter/26') ? 'class=active' : '')}}}>Hair Care</a></li>
               <li><a href="{{ url('/ProductFilter/27')}}" {{{ (Request::is('ProductFilter/27') ? 'class=active' : '')}}}>Essential Oil</a></li>
         </ul>
   </li>

   <li class="dropdown"><a href="#" {{{ (
      Request::is('ProductFilter/28')? 'class=active' : '')}}}>Sample Size<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/ProductFilter/28')}}" {{{ (Request::is('ProductFilter/28') ? 'class=active' : '')}}}>Sample Size</a></li>
         </ul>
   </li> -->

   @if(Auth::check())
      @if($Role == 1 || $Role == 2)
      <li class="dropdown"><a href="#" {{{ (Request::is('Product') || Request::is('Category') || Request::is('SubCategory') || Request::is('Brands') ||
            Request::is('ProductStatus') || Request::is('SalesOrderStatus') || Request::is('Employee') || Request::is('Role') ||
            Request::is('Customer') || Request::is('CompanyDescription') || Request::is('Bank') || Request::is('Slider') ||
            Request::is('SocialMedia')? 'class=active' : '')}}}>Master Data<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                  <li><a href="{{ url('/Product')}}" {{{ (Request::is('Product') ? 'class=active' : '')}}}>Product</a></li>
                  <li><a href="{{ url('/Category')}}" {{{ (Request::is('Category') ? 'class=active' : '')}}}>Category</a></li>
                  <li><a href="{{ url('/SubCategory')}}" {{{ (Request::is('SubCategory') ? 'class=active' : '')}}}>Sub Category</a></li>
                  <li><a href="{{ url('/Brand')}}" {{{ (Request::is('Brand') ? 'class=active' : '')}}}>Brand</a></li>

                  @if($Role == 1)
                     <li><a href="{{ url('/ProductStatus')}}" {{{ (Request::is('ProductStatus') ? 'class=active' : '')}}}>Product Status</a></li>
                     <li><a href="{{ url('/SalesOrderStatus')}}" {{{ (Request::is('SalesOrderStatus') ? 'class=active' : '')}}}>Sales Order Status</a></li>
                     <li><a href="{{ url('/Employee')}}" {{{ (Request::is('Employee') ? 'class=active' : '')}}}>Employee</a></li>
                     <li><a href="{{ url('/Role')}}" {{{ (Request::is('Role') ? 'class=active' : '')}}}>Role</a></li>
                     <li><a href="{{ url('/Customer')}}" {{{ (Request::is('Customer') ? 'class=active' : '')}}}>Customer</a></li>
                     <li><a href="{{ url('/CompanyDescription')}}" {{{ (Request::is('CompanyDescription') ? 'class=active' : '')}}}>Company Description</a></li>
                     <li><a href="{{ url('/Bank')}}" {{{ (Request::is('Bank') ? 'class=active' : '')}}}>Bank</a></li>
                  @endif

                  <li><a href="{{ url('/Slider')}}" {{{ (Request::is('Slider') ? 'class=active' : '')}}}>Slider</a></li>
                  <li><a href="{{ url('/SocialMedia')}}" {{{ (Request::is('SocialMedia') ? 'class=active' : '')}}}>Social Media</a></li>
            </ul>
       </li>

       <li><a href="{{ url('/Inventory')}}" {{{ (Request::is('/Inventory') ? 'class=active' : '')}}}>Inventory</a></li>

       <li><a href="{{ url('/TransactionEmployee')}}" {{{ (Request::is('/Transaction') ? 'class=active' : '')}}}>Transaction</a></li>
       @else
         <li><a href="{{ url('/TransactionCustomer')}}" {{{ (Request::is('/Transaction') ? 'class=active' : '')}}}>Transaction</a></li>
       @endif
    @endif
</ul>

@section('Address', $Content[0]['Alamat'])
@section('Phone',$Content[0]['Telepon'])
@section('Handphone',$Content[0]['Handphone'])
@section('Email',$Content[0]['Email'])
@section('City',$Content[0]['Kota'])
@section('Country',$Content[0]['Negara'])
@section('CompanyName')
   <?php
      $Nama = $Content[0]['Nama'];
      $ArrayNama = explode(" ",$Nama);

      echo '<span><strong style="font-size:40px;">'.$ArrayNama[0][0].'</strong>'.substr($ArrayNama[0],1).' <strong style="font-size:40px;">'.$ArrayNama[1][0].'</strong>'.substr($ArrayNama[1],1).'</span> <strong style="font-size:40px;">'.$ArrayNama[2][0].'</strong>'.substr($ArrayNama[2],1);
   ?>
@endsection
@section('CompanyNameII',$Content[0]['Nama'])
