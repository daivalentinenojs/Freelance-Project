<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\SocialMedia;
use DB;

class SocialMedia extends Model
{
    protected $table = 'SosialMedia';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Nama', 'Keterangan', 'Link', 'IsActive'];

    public function GetAjaxSocialMedia()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $requestData= $_REQUEST;
        $columns = array(
          0 => 'ID',
          1 => 'SocialMediaName',
          2 => 'Description',
          3 => 'Link',
          4 => 'Status',
          5 => 'View',
          6 => 'Edit',
        );

        // Ambil Semua Baris Data
        $sql = "SELECT SosialMedia.ID AS 'ID', SosialMedia.ID AS 'View', SosialMedia.ID AS 'Edit',
        SosialMedia.Nama AS 'SocialMediaName', SosialMedia.Keterangan AS 'Description', SosialMedia.Link AS 'Link', SosialMedia.IsActive AS 'Status' FROM SosialMedia";
        $query=mysqli_query($MySQLi, $sql);
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;

        // Proses Cari
        $sql = "SELECT SosialMedia.ID AS 'ID', SosialMedia.ID AS 'View', SosialMedia.ID AS 'Edit',
        SosialMedia.Nama AS 'SocialMediaName', SosialMedia.Keterangan AS 'Description', SosialMedia.Link AS 'Link', SosialMedia.IsActive AS 'Status' FROM SosialMedia";
        if( !empty($requestData['search']['value']) ) {
          $sql.=" WHERE ( SosialMedia.ID LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR SosialMedia.Nama LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SosialMedia.Keterangan LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SosialMedia.Link LIKE '%".$requestData['search']['value']."%'";
          $sql.=" OR SosialMedia.IsActive LIKE '%".$requestData['search']['value']."%' )";
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
          $nestedData[] = $row["SocialMediaName"];
          $nestedData[] = $row["Description"];
          $nestedData[] = $row["Link"];
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

    public function GetSocialMedia()
    {
        require '../connection/Init.php';
        $MySQLi = mysqli_connect($domain, $username, $password, $database);

        $QueryGetDataSosialMedia = "SELECT SosialMedia.ID AS 'ID', SosialMedia.Nama AS 'SocialMediaName', SosialMedia.Keterangan AS 'Description',  SosialMedia.Link AS 'Link', SosialMedia.IsActive AS 'Status' FROM SosialMedia";
        $HasilQueryGetDataSosialMedia = mysqli_query($MySQLi, $QueryGetDataSosialMedia);
        $DataSosialMedia = array();
        while($Hasil = mysqli_fetch_assoc($HasilQueryGetDataSosialMedia)) {
        $DataSosialMedia[] = $Hasil;
        }
        return $DataSosialMedia;
    }

    public function StoreSocialMedia(Request $Request)
    {
        $unique_id = uniqid();
        $SosialMedia = new SocialMedia(array(
            'Nama' => $Request->get('NamaSosialMedia'),
            'Keterangan' => $Request->get('Deskripsi'),
            'Link' => $Request->get('Link'),
            'IsActive' => (1)
        ));
        $SosialMedia->save();
    }

    public function UpdateSocialMedia(Request $Request)
    {
        $IDSosialMedia = $Request->get('IDSosialMedia');
        DB::table('SosialMedia')
            ->where('ID', $IDSosialMedia)
            ->update(['Nama' => $Request->get('NamaSosialMedia'),
                    'Keterangan' => $Request->get('Deskripsi'),
                    'Link' => $Request->get('Link'),
                    'IsActive' => $Request->get('Status')]);
    }
}
