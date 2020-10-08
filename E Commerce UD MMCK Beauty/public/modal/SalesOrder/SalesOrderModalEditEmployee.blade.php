<?php
if(isset($_POST["ID"])) {
       require '../../../connection/Init.php';
       $MySQLi = mysqli_connect($domain, $username, $password, $database);

       $IDNotaJual = $MySQLi->real_escape_string($_POST["ID"]);;

       $QueryGetDataNotaJual = "SELECT NotaJual.ID AS ID, NotaJual.TotalBerat AS TotalBerat, NotaJual.TanggalBuat AS TanggalBuat,
                         NotaJual.TotalBarang AS TotalBarang, NotaJual.BiayaKirim AS BiayaKirim, NotaJual.TotalAkhir AS TotalAkhir,
                         NotaJual.NamaPenerima AS NamaPenerima, NotaJual.AlamatPenerima AS AlamatPenerima, NotaJual.Provinsi AS Provinsi, NotaJual.Kota AS Kota,
                         NotaJual.TeleponPenerima AS TeleponPenerima, NotaJual.HandphonePenerima AS HandphonePenerima, NotaJual.NomorRekening AS NomorRekening,
                         NotaJual.NamaPemilikRekening AS NamaPemilikRekening, NotaJual.TanggalTransfer AS TanggalTransfer, NotaJual.TanggalKirim AS TanggalKirim,
                         NotaJual.Kecamatan AS Kecamatan, NotaJual.Kelurahan AS Kelurahan, NotaJual.KodePos AS KodePos, NotaJual.Keterangan AS Keterangan, NotaJual.NomorResi AS NomorResi,
                         NotaJual.TanggalTerima AS TanggalTerima, NotaJual.NamaDropshipper AS NamaDropshipper, NotaJual.TeleponDropshipper AS TeleponDropshipper,
                         NotaJual.HandphoneDropshipper AS HandphoneDropshipper, NotaJual.IDBank AS IDBank, Bank.Nama AS NamaBank, NotaJual.IsDropship AS IsDropship, Bank.NamaPemilikRekening AS BankNamaPemilikRekening, Bank.NomorRekening AS BankNomorRekening,
                         NotaJual.IDStatusNotaJual AS IDStatusNotaJual, StatusNotaJual.Nama AS StatusNotaJual, NotaJual.IDPembeli AS IDPembeli, Pembeli.Nama AS NamaPembeli,
                         NotaJual.IDKaryawan AS IDKaryawan, Karyawan.Nama AS NamaKaryawan
                         FROM NotaJual INNER JOIN Bank ON NotaJual.IDBank = Bank.ID
                         LEFT JOIN Karyawan ON NotaJual.IDKaryawan = Karyawan.ID
                         INNER JOIN Pembeli ON NotaJual.IDPembeli = Pembeli.ID
                         INNER JOIN StatusNotaJual ON NotaJual.IDStatusNotaJual = StatusNotaJual.ID
                         WHERE NotaJual.ID = '$IDNotaJual'";
       $HasilQueryGetDataNotaJual = mysqli_query($MySQLi, $QueryGetDataNotaJual);
       $DataNotaJual = array();
       while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataNotaJual)) {
       	$DataNotaJual[] = $Hasil;
       }

       $QueryGetDataBarangXNotaJual = "SELECT BarangXNotaJual.ID AS ID, BarangXNotaJual.IDBarang AS IDBarang,
           BarangXNotaJual.IDNotaJual AS IDNotaJual, BarangXNotaJual.Jumlah AS Jumlah, Barang.Nama AS NamaBarang,
           BarangXNotaJual.HargaReal AS HargaReal, BarangXNotaJual.SubTotal AS SubTotal
           FROM BarangXNotaJual INNER JOIN NotaJual ON BarangXNotaJual.IDNotaJual = NotaJual.ID
           INNER JOIN Barang ON BarangXNotaJual.IDBarang = Barang.ID
           WHERE BarangXNotaJual.IDNotaJual = '$IDNotaJual'";
         $HasilQueryGetDataBarangXNotaJual = mysqli_query($MySQLi, $QueryGetDataBarangXNotaJual);
         $DataBarangXNotaJual = array();
         while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataBarangXNotaJual)) {
           $DataBarangXNotaJual[] = $Hasil;
         }
}
?>

<form class="form-horizontal" id="FormDetailNotaJual" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                    <div class="form-group">
                          <label class="col-md-2 control-label">Number</label>
                          <div class="col-md-4">
                               <input type="hidden" name="IDNotaJual" value="<?php echo $DataNotaJual[0]['ID']; ?>">
                               <input type="hidden" name="IDStatusNotaJual" value="<?php echo $DataNotaJual[0]['IDStatusNotaJual']; ?>">
                               <input type="text" readonly class="form-control" value="<?php echo $DataNotaJual[0]['ID']; ?>"  style="background:white; color:black;"/>
                          </div>
                          <label class="col-md-2 control-label">Date</label>
                          <div class="col-md-4">
                               <input type="text" readonly class="form-control" value="<?php echo date('d M Y', strtotime($DataNotaJual[0]['TanggalBuat'])); ?>"  style="background:white; color:black;"/>
                          </div>
                   </div><br>
                   <div class="col-md-12 scCol" style="background:white;">
                       <div class="panel panel-success" id="grid_block_12">
                         <div class="panel-heading">
                            <h3 class="panel-title">Recipient Information (Confirmation)</h3>
                         </div>
                         <div class="panel-body">
                                <div class="form-group">
                                     <label class="col-md-2 control-label">Name</label>
                                     <div class="col-md-4">
                                          <input type="text" name="Nama" readonly class="form-control" value="<?php echo $DataNotaJual[0]['NamaPenerima']; ?>"  style="background:white; color:black;"/>
                                     </div>
                                     <label class="col-md-2 control-label">Address</label>
                                     <div class="col-md-4">
                                          <input type="text" name="Nama" readonly class="form-control" value="<?php echo $DataNotaJual[0]['AlamatPenerima']; ?>"  style="background:white; color:black;"/>
                                     </div>
                               </div>
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Phone</label>
                                    <div class="col-md-4">
                                         <input type="text" name="Nama" readonly class="form-control" value="<?php echo $DataNotaJual[0]['TeleponPenerima']; ?>"  style="background:white; color:black;"/>
                                    </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-2 control-label">City</label>
                                   <div class="col-md-4">
                                       <input type="text" name="Nama" readonly class="form-control" value="<?php echo $DataNotaJual[0]['Kota']; ?>"  style="background:white; color:black;"/>
                                   </div>
                                   <label class="col-md-2 control-label">Province</label>
                                   <div class="col-md-4">
                                       <input type="text" name="Nama" readonly class="form-control" value="<?php echo $DataNotaJual[0]['Provinsi']; ?>"  style="background:white; color:black;"/>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-2 control-label">Districts</label>
                                   <div class="col-md-4">
                                       <input type="text" name="Kecamatan" readonly class="form-control" value="<?php echo $DataNotaJual[0]['Kecamatan']; ?>"  style="background:white; color:black;"/>
                                   </div>
                                   <label class="col-md-2 control-label">Headman</label>
                                   <div class="col-md-4">
                                       <input type="text" name="Kelurahan" readonly class="form-control" value="<?php echo $DataNotaJual[0]['Kelurahan']; ?>"  style="background:white; color:black;"/>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-2 control-label">Postal</label>
                                   <div class="col-md-4">
                                       <input type="text" name="KodePos" readonly class="form-control" value="<?php echo $DataNotaJual[0]['KodePos']; ?>"  style="background:white; color:black;"/>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <label class="col-md-2 control-label">Note</label>
                                   <div class="col-md-4">
                                          <p style="margin-top:5px;"><?php echo $DataNotaJual[0]['Keterangan']; ?></p>
                                   </div>
                              </div>
                         </div>
                       </div>
                  </div>
                 <?php
                 if ($DataNotaJual[0]['IsDropship'] == 1) {
                        echo '<div class="col-md-12 scCol" style="background:white;">
                           <div class="panel panel-danger" id="grid_block_12">
                             <div class="panel-heading">
                                <h3 class="panel-title">Dropship Information (Confirmation)</h3>
                             </div>
                             <div class="panel-body">
                                     <div class="form-group">
                                          <label class="col-md-2 control-label">Name</label>
                                          <div class="col-md-4">
                                              <input type="text" readonly name="NamaDropshipper" class="form-control" value="'.$DataNotaJual[0]['NamaDropshipper'].'"  style="background:white; color:black;"/>
                                          </div>
                                          <label class="col-md-2 control-label">Phone</label>
                                          <div class="col-md-4">
                                              <input type="text" readonly name="Nama" class="form-control" value="'.$DataNotaJual[0]['TeleponDropshipper'].'"  style="background:white; color:black;"/>
                                          </div>
                                   </div>
                             </div>
                           </div>
                      </div>';
                 }
                 ?>
                 <div class="col-md-12 scCol" style="background:white;">
                    <div class="panel panel-primary" id="grid_block_12">
                      <div class="panel-heading">
                         <h3 class="panel-title">Product Information (Confirmation)</h3>
                      </div>
                      <div class="panel-body">
                            <table class="table" id="DataTableProduct">
                                   <thead>
                                        <tr>
                                             <th style="text-align:center;">ID</th>
                                             <th style="text-align:center;">Name</th>
                                             <th style="text-align:center;">Cost</th>
                                             <th style="text-align:center;">Quantity</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                          <?php
                                          foreach ($DataBarangXNotaJual as $BXN) {
                                                 echo '<tr>
                                                        <td style="text-align:center;">'.$BXN['IDBarang'].'</td>
                                                        <td style="text-align:center;">'.$BXN['NamaBarang'].'</td>
                                                        <td style="text-align:center;">'.'IDR '.number_format($BXN['HargaReal'],0,'.',',').'</td>
                                                        <td style="text-align:center;">'.$BXN['Jumlah'].'</td>
                                                 </tr>';
                                          }
                                          ?>
                                   </tbody>
                                   <tfoot>
                                       <tr>
                                              <th style="text-align:center;">ID</th>
                                             <th style="text-align:center;">Name</th>
                                             <th style="text-align:center;">Cost</th>
                                             <th style="text-align:center;">Quantity</th>
                                       </tr>
                                   </tfoot>
                                </table>
                      </div>
                    </div>
               </div>
               <div class="col-md-12 scCol" style="background:white;">
                  <div class="panel panel-default" id="grid_block_12">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cost Information (Confirmation)</h3>
                    </div>
                    <div class="panel-body">
                            <div class="form-group">
                                 <label class="col-md-2 control-label">Product</label>
                                 <div class="col-md-4">
                                     <input type="text" readonly name="Nama" class="form-control" value="<?php echo 'IDR '.number_format($DataNotaJual[0]['TotalBarang'],0,'.',',') ?>"  style="background:white; color:black;"/>
                                 </div>
                                 <label class="col-md-2 control-label">Shipment</label>
                                 <div class="col-md-4">
                                     <input type="text" readonly name="Nama" class="form-control" value="<?php echo 'IDR '.number_format($DataNotaJual[0]['BiayaKirim'],0,'.',',') ?>"  style="background:white; color:black;"/>
                                 </div>
                          </div>
                          <div class="form-group">
                                <label class="col-md-2 control-label">Total</label>
                                <div class="col-md-8">
                                       <input type="text" readonly name="Nama" class="form-control" value="<?php echo 'IDR '.number_format($DataNotaJual[0]['TotalAkhir'],0,'.',',') ?>"  style="background:white; color:black;"/>
                                </div>
                         </div>
                    </div>
                  </div>
             </div>
             <div class="col-md-12 scCol" style="background:white;">
                 <div class="panel panel-warning" id="grid_block_12">
                  <div class="panel-heading">
                      <h3 class="panel-title">Bank Information (Confirmation)</h3>
                  </div>
                  <div class="panel-body">
                          <p>Please fill the required field with your transfer data</p>
                          <div class="form-group">
                               <label class="col-md-2 control-label">Number</label>
                               <div class="col-md-4">
                                    <input type="text" readonly name="NomorRekening" class="form-control" value="<?php echo $DataNotaJual[0]['NomorRekening']; ?>"  style="background:white; color:black;"/>
                               </div>
                               <label class="col-md-2 control-label">Name</label>
                               <div class="col-md-4">
                                     <input type="text" readonly name="NamaPemilikRekening" class="form-control" value="<?php echo $DataNotaJual[0]['NamaPemilikRekening']; ?>"  style="background:white; color:black;"/>
                               </div>
                         </div>
                         <div class="form-group">
                              <label class="col-md-2 control-label">To</label>
                              <div class="col-md-10">
                                   <input type="text" readonly name="NamaPemilikRekening" class="form-control" value="(<?php echo $DataNotaJual[0]['BankNomorRekening'] ?>) <?php echo $DataNotaJual[0]['NamaBank']; ?> an <?php echo $DataNotaJual[0]['BankNamaPemilikRekening']; ?>"  style="background:white; color:black;"/>
                              </div>
                       </div>
                       <?php
                            if ($DataNotaJual[0]['IDStatusNotaJual'] == 3) {
                                   echo '<div class="form-group">
                                       <label class="col-md-4 control-label">Shipment Number</label>
                                       <div class="col-md-8">
                                            <input type="text" required id="NomorResi" name="NomorResi" class="form-control" value=""  style="background:white; color:black;"/>
                                       </div>
                                   </div>';
                            } else if ($DataNotaJual[0]['IDStatusNotaJual'] == 4) {
                                   echo '<div class="form-group">
                                       <label class="col-md-4 control-label">Shipment Number</label>
                                       <div class="col-md-8">
                                            <input type="text" readonly required id="NomorResi" name="NomorResi" class="form-control" value="'.$DataNotaJual[0]['NomorResi'].'"  style="background:white; color:black;"/>
                                       </div>
                                   </div>';
                            }
                       ?>
                       <div class="form-group">
                           <label class="col-md-2 control-label">Status</label>
                           <div class="col-md-10">
                                  <select name="IDStatusNotaJualBaru" required class="form-control select" data-live-search="true">
                                  <?php
                                         if ($DataNotaJual[0]['IDStatusNotaJual'] == 3) {
                                                echo '<option value = "4">Deliver Product</option>';
                                                echo '<option value = "1">Cancel Sales Order</option>';
                                         } else if($DataNotaJual[0]['IDStatusNotaJual'] == 4)  {
                                                echo '<option value = "5">Finished</option>';
                                                echo '<option value = "1">Cancel Sales Order</option>';
                                         } else {
                                                echo '<option value = "1">Cancel Sales Order</option>';
                                         }
                                  ?>
                                  </select>
                     </div>
                      </div>
                  </div>
                 </div>
           </div>
           <div class="form-group" style="text-align:center;">
           <?php
           if ($DataNotaJual[0]['IDStatusNotaJual'] == 3) {
                  echo '<input type="submit" name="BtnEditNotaJual" value="Payment Confirmation" class="btn btn-success">';
           } else if($DataNotaJual[0]['IDStatusNotaJual'] == 4)  {
                  echo '<input type="submit" name="BtnEditNotaJual" value="Shipment Confirmation" class="btn btn-success">';
           } else {
                  echo '<input type="submit" name="BtnEditNotaJual" value="Cancel Sales Order" class="btn btn-success">';
           }
           ?>
           </div>
      </div>
 </div>
</div>
</form>
