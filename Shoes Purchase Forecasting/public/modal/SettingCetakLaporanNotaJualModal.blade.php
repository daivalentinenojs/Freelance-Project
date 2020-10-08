<form class="form-horizontal" id="FormTambahJabatan" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
               <div class="form-group">
                    <label class="col-md-5 control-label">Tanggal Awal</label>
                    <div class="col-md-3">
                           <div class="input-group">
                                <input type="date" id='TanggalAwal' name="TanggalCetakAwal" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                    </div>
               </div>

               <div class="form-group">
                    <label class="col-md-5 control-label">Tanggal Akhir</label>
                    <div class="col-md-3">
                           <div class="input-group">
                                <input type="date" id='TanggalAkhir' name="TanggalCetakAkhir" required class="form-control" value="<?php echo date("Y-m-d");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                           </div>
                    </div>
               </div>
               <div class="form-group" style="text-align:center;">
                      <button type="button" id="buttonPrint" onclick="printData();" class="btn btn-info">Print</button>
               </div>
             </div>
        </div>
</div>
</form>
<script>
  function printData()
  {
    //window.open("CetakLaporanNotaBeli/<!?php echo $DataPesanPembelian[0]['Nomor']?>","_blank");
    //alert(document.getElementByName('TanggalCetakAkhir').value);
    window.open("CetakLaporanNotaJual?tanggalAwal="+$("#TanggalAwal").val()+"&tanggalAkhir="+$("#TanggalAkhir").val(),"_blank");

  }
</script>
