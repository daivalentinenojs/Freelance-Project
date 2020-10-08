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

       $QueryGetDataSubKategori = "SELECT SubKategori.ID AS ID, SubKategori.ID AS View, SubKategori.ID AS Edit, SubKategori.Nama AS Nama, SubKategori.Keterangan AS Keterangan,
                    SubKategori.IDKategori AS IDSKategori, Kategori.Nama AS 'NamaKategori', SubKategori.IsActive AS 'Status'
                    FROM SubKategori INNER JOIN Kategori ON Kategori.ID = SubKategori.IDKategori";
       $HasilQueryGetDataSubKategori = mysqli_query($MySQLi, $QueryGetDataSubKategori);
       $DataSubKategori = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSubKategori)) {
              $DataSubKategori[] = $Hasil;
       }

       $QueryGetDataBrand = "SELECT Merk.ID AS 'ID', Merk.Nama AS 'BrandName', Merk.Keterangan AS 'Description', Merk.IsActive AS 'Status' FROM Merk";
       $HasilQueryGetDataBrand = mysqli_query($MySQLi, $QueryGetDataBrand);
       $DataBrand = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBrand)) {
              $DataBrand[] = $Hasil;
       }

       $QueryGetDataProductStatus = "SELECT StatusBarang.ID AS 'ID', StatusBarang.Nama AS 'ProductStatusName', StatusBarang.IsActive AS 'Status' From StatusBarang";
       $HasilQueryGetDataProductStatus = mysqli_query($MySQLi, $QueryGetDataProductStatus);
       $DataProductStatus = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataProductStatus)) {
              $DataProductStatus[] = $Hasil;
       }

       if ($DataBarang[0]['Promo'] == 1) {
              $Promo = "Discount";
       } else {
              $Promo = "Undiscount";
       }
}
?>

<form class="form-horizontal" id="FormDetailBarang" method="POST" action="Inventory" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group" style="text-align:center">
                        <img width="110px" height="150px" src="foto/Barang/<?php echo $DataBarang[0]['ID'] ?>.jpg">
                    </div><br>
                    <div class="form-group">
                          <label class="col-md-4 control-label">ID</label>
                          <div class="col-md-3">
                               <input type="hidden" name="IDBarang" value="<?php echo $DataBarang[0]['ID']; ?>">
                               <input type="text"  readonly class="form-control" value="<?php echo $DataBarang[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Product Name</label>
                          <div class="col-md-5">
                               <input type="text" readonly name="Nama" class="form-control" value="<?php echo $DataBarang[0]['Nama']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Description</label>
                        <div class="col-md-6">
                               <textarea readonly name="Keterangan" rows="8" cols="60"><?php echo $DataBarang[0]['Keterangan']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Stock</label>
                          <div class="col-md-3">
                               <input type="text" required name="Stok" class="form-control" value="<?php echo $DataBarang[0]['Stok']; ?>"  style="background:white; color:black;"/>
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
                               <input type="text" readonly name="HargaBeli" class="form-control" value="<?php echo $DataBarang[0]['HargaBeli']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Selling Price</label>
                          <div class="col-md-5">
                               <input type="text" readonly name="HargaJual" class="form-control" value="<?php echo $DataBarang[0]['HargaJual']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
                    <div class="form-group">
                          <label class="col-md-4 control-label">Promo Selling Price</label>
                          <div class="col-md-5">
                               <input type="text" readonly name="HargaJualPromo" class="form-control" value="<?php echo $DataBarang[0]['HargaJualPromo']; ?>"  style="background:white; color:black;"/>
                          </div>
                    </div>
              <div class="form-group" style="text-align:center;">
                     <input type="submit" name="BtnEditBarang" value="Change" class="btn btn-warning">
              </div>
             </div>
        </div>
</div>
</form>
