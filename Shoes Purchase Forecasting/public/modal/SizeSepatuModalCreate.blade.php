<form class="form-horizontal" id="FormTambahSizeSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <!--div class="form-group">
                       <label class="col-md-3 control-label">Jenis Ukuran</label>
                       <div class="col-md-7">
                            <input type="radio"  name="UkuranAtauBox" value="Box" style="background:white; color:black;"/>Box &nbsp &nbsp &nbsp &nbsp
                            <input type="radio"  name="UkuranAtauBox" value="Ukuran" style="background:white; color:black;"/>Ukuran
                       </div>
                 </div-->
                 <div class="form-group">
                       <label class="col-md-3 control-label">Ukuran Sepatu</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Box atau Ukuran" name="NamaSizeSepatu" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateSizeSepatu" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
