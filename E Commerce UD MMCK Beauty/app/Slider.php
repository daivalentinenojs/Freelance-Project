<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Slider;
use DB;

class Slider extends Model
{
    protected $table = 'Slider';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Judul', 'Keterangan', 'IsActive'];

    public function GetAjaxSlider()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'SliderName',
          2 => 'Title',
          3 => 'Description',
          4 => 'Status',
          5 => 'View',
          6 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit',
        Slider.Nama AS 'SliderName', Slider.Judul AS 'Title', Slider.Keterangan AS 'Description', Slider.IsActive AS 'Status' FROM Slider";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT Slider.ID AS 'ID', Slider.ID AS 'View', Slider.ID AS 'Edit',
        Slider.Nama AS 'SliderName', Slider.Judul AS 'Title', Slider.Keterangan AS 'Description', Slider.IsActive AS 'Status' FROM Slider";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( Slider.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR Slider.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Slider.Judul LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Slider.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR Slider.IsActive LIKE '%".$requestData['search']['value']."%' )";
        }

        $query=mysqli_query($MySQLi, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $query=mysqli_query($MySQLi, $sql);
        $data = array();

        while( $row=mysqli_fetch_array($query) ) {
          $nestedData=array();

          if ($row["Status"] == 1) {
              $Status = 'Active';
          } else {
              $Status = 'InActive';
          }

          $nestedData[] = $row["ID"];
          $nestedData[] = $row["SliderName"];
          $nestedData[] = $row["Title"];
          $nestedData[] = $row["Description"];
          $nestedData[] = $Status;
          $nestedData[] = $row["View"];
          $nestedData[] = $row["Edit"];
          $data[] = $nestedData;
        }

        $json_data = array(
                  "draw"            => intval( $requestData['draw'] ),
                  "recordsTotal"    => intval( $totalData ),
                  "recordsFiltered" => intval( $totalFiltered ),
                  "data"            => $data
                  );

        echo json_encode($json_data);
    }

    public function GetSlider()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataSlider = "SELECT Slider.ID AS 'ID', Slider.Nama AS 'SliderName',  Slider.Judul AS 'Title',
        Slider.Keterangan AS 'Description', Slider.IsActive AS 'Status' FROM Slider WHERE Slider.IsActive = '1'";
        $HasilQueryGetDataSlider = mysqli_query($MySQLi, $QueryGetDataSlider);
        $DataSlider = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSlider)) {
        $DataSlider[] = $Hasil;
        }
        return $DataSlider;
    }

    public function StoreSlider(Request $Request)
    {
        $unique_id = uniqid();
        $Slider = new Slider(array(
            'Nama' => $Request->get('NamaSlider'),
            'Judul' => $Request->get('Judul'),
            'Keterangan' => $Request->get('Deskripsi'),
            'IsActive' => (1)
        ));
        $Slider->save();
        $ID = DB::table('Slider')->max('ID');
        $IDSlider = $ID.'.jpg';
        if($Request->hasFile('FotoSlider')) {
            $Request->FotoSlider->move(public_path('foto/slider'), $IDSlider);
        }
    }

    public function UpdateSlider(Request $Request)
    {
        $IDSlider = $Request->get('IDSlider');
        DB::table('Slider')
            ->where('ID', $IDSlider)
            ->update(['Nama' => $Request->get('NamaSlider'),
                    'Judul' => $Request->get('Judul'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'IsActive' => $Request->get('Status')]);
        $IDSliderInput = $IDSlider.'.jpg';
        if($Request->hasFile('FotoSlider')) {
            $Request->FotoSlider->move(public_path('foto/slider'), $IDSliderInput);
        }
    }
}
