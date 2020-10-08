<form class="form-horizontal" id="FormTambahSepatu" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="modal-body">
       <div class="panel-body">
             <div class="col-md-12">
                 <div class="form-group" style="text-align:center">
                       <!--img width="150px" height="160px" src="foto/User.png"-->
                 </div>
                 <div class="form-group">
                       <label class="col-md-3 control-label">Sepatu</label>
                       <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Sepatu" name="NamaSepatu" value="" style="background:white; color:black;"/>
                       </div>
                 </div>

                 <div class="form-group" style="text-align:center;">
                        <input type="submit" name="BtnCreateSepatu" value="Tambah" class="btn btn-success">
                 </div>
             </div>
        </div>
</div>
</form>
