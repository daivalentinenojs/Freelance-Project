<form class="form-horizontal" id="FormTambahWarna" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Warna</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Warna" name="NamaWarna" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateWarna" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
