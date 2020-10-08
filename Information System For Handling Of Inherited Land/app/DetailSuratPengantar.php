<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\DetailSuratPengantar;
use DB;

class DetailSuratPengantar extends Model
{
  protected $table = 'DetailSuratPengantar';
  protected $guarded = ['Nomor'];
  protected $fillable = ['Nomor', 'Keterangan', 'Naskah', 'Jumlah', 'NomorSuratPengantar', 'IsActive'];

  public function StoreDetailSuratPengantar(Request $Request, $NomorSuratPengantar) {
      $unique_id = uniqid();
      $Keterangan = $Request->get('ArrayKeterangan');
      $Naskah = $Request->get('ArrayNaskah');
      $Jumlah = $Request->get('ArrayJumlah');

      for ($i=0; $i < count($Keterangan); $i++) {
          $DetailSPS = new DetailSuratPengantar(array(
              'Keterangan' => $Keterangan[$i],
              'Naskah' => $Naskah[$i],
              'Jumlah' => $Jumlah[$i],
              'NomorSuratPengantar' => $NomorSuratPengantar,
              'IsActive' => (1),
          ));
          $DetailSPS->save();
      }
  }
}
