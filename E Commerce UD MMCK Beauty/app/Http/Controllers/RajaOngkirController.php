<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    function GetProvince() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          //   CURLOPT_URL => "https://rajaongkir.com/starter/province",
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            print_r($data);
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
            }
        }
    }

    function GetToProvince() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          //   CURLOPT_URL => "https://rajaongkir.com/starter/province",
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            print_r($data);
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
            }
        }
    }

    function GetToProvincePrint($ID) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          //   CURLOPT_URL => "https://rajaongkir.com/starter/province",
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$ID",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            echo $data['rajaongkir']['results']['province'];
        }
    }

    function GetCity(Request $Request, $ID) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$ID",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            //   echo $response;
            $data = json_decode($response, true);
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            }
        }
    }

    function GetToCity(Request $Request, $ID) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$ID",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            //   echo $response;
            $data = json_decode($response, true);
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            }
        }
    }

    function GetToCityPrint(Request $Request, $ID) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$ID",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            echo $data['rajaongkir']['results']['city_name'];
            // for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
            //     echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            // }
        }
    }

    function GetCost(Request $Request, $ID, $Berat) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=155&destination=$ID&weight=$Berat&courier=jne",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 23bad5bf15f9be41ff2240bb08e76b55"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $data = json_decode($response, true);
            // print_r($data['rajaongkir']['results'][0]['costs']);
            if (!empty($data['rajaongkir']['results'][0]['costs'])) {
                echo '<select name="BiayaKirim" id="BiayaKirim" required class="form-control select" data-live-search="true">';
                for ($i=0; $i < count($data['rajaongkir']['results'][0]['costs']); $i++) {
                    echo "<option value='".$data['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['value']."'>".$data['rajaongkir']['results'][0]['costs'][$i]['service']." ".
                    $data['rajaongkir']['results'][0]['costs'][$i]['description']." (".$data['rajaongkir']['results'][0]['costs'][$i]['cost'][0]['value'].")</option>";
                }
                echo '</select><br />*OKE (4 - 5 days), Reguler (1 - 3) days</span>';
            } else {
                echo "<div style='margin-top:10px;'>No shipment cost listed</div>";
            }
        }
    }
}
