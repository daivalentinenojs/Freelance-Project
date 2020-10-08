<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDBarang = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataBarang = "SELECT Barang.ID AS ID, Barang.ID AS View, Barang.ID AS Edit, Barang.Nama AS Nama, Barang.Keterangan AS Keterangan,
                            Barang.Stok AS Stok, Barang.Berat AS Berat, Barang.HargaBeli AS HargaBeli, Barang.HargaJual AS HargaJual,
                            Barang.HargaJualPromo AS HargaJualPromo, Barang.IDSubKategori AS IDSubKategori,
                            Barang.IDMerk AS IDMerk, Barang.IDStatusBarang AS IDStatusBarang, Barang.IsPromo AS 'Promo', Barang.IsActive AS 'Status',
                            SubKategori.Nama AS 'NamaSubKategori', Merk.Nama AS 'NamaMerk', StatusBarang.Nama AS 'StatusBarang'
                            FROM Barang INNER JOIN SubKategori ON Barang.IDSubKategori = SubKategori.ID
                            INNER JOIN Merk ON Merk.ID = Barang.IDMerk
                            INNER JOIN StatusBarang ON StatusBarang.ID = Barang.IDStatusBarang
                            WHERE Barang.ID = '$IDBarang'";
       $HasilQueryGetDataBarang = mysqli_query($MySQLi, $QueryGetDataBarang);
       $DataBarang = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarang)) {
       	$DataBarang[] = $Hasil;
       }

       if ($DataBarang[0]['Status'] == 1) {
              $Status = "Active";
       } else {
              $Status = "InActive";
       }

       if ($DataBarang[0]['Promo'] == 1) {
              $Promo = "Discount";
       } else {
              $Promo = "Undiscount";
       }
}
?>

<form class="form-horizontal" id="FormDetailBarang" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" style="border-radius:20px; border: 2px solid black;" src="foto/Barang/<?php echo $DataBarang[0]['ID'] ?>.jpg">
                    </div><br>
                 <div class="form-group">
                       <label class="col-md-4 control-label">ID</label>
                       <div class="col-md-3">
                            <input type="hidden" name="IDBarang" value="<?php echo $DataBarang[0]['ID']; ?>">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['ID']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Product Name</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Nama']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Description</label>
                     <div class="col-md-6">
                            <p readonly name="Description" rows="8" cols="60">
                                   <?php echo $DataBarang[0]['Keterangan']; ?>
                            </p>
                     </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Stock</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Stok']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Weight (gram)</label>
                       <div class="col-md-3">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['Berat']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Purchasing Price</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo 'IDR '.number_format( $DataBarang[0]['HargaBeli'],0,',','.'); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Selling Price</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo 'IDR '.number_format( $DataBarang[0]['HargaJual'],0,',','.'); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Promo Selling Price</label>
                       <div class="col-md-5">
                            <input type="text" class="form-control" value="<?php echo 'IDR '.number_format( $DataBarang[0]['HargaJualPromo'],0,',','.'); ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Sub Category</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['NamaSubKategori']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Brand</label>
                       <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['NamaMerk']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Product Status</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $DataBarang[0]['StatusBarang']; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                       <label class="col-md-4 control-label">Promo</label>
                       <div class="col-md-4">
                            <input type="text" class="form-control" value="<?php echo $Promo; ?>" readonly style="background:white; color:black;"/>
                       </div>
                 </div>
                 <div class="form-group">
                     <label class="col-md-4 control-label">Status</label>
                     <div class="col-md-4">
                          <input type="text" class="form-control" value="<?php echo $Status; ?>" readonly style="background:white; color:black;"/>
                     </div>
               </div>
             </div>
        </div>
</div>
</form>
