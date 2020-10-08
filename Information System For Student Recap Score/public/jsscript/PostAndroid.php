<?php
class Upload
{

   public function Upload()
   {
      require '../../connection/RekapNilai.php';
   	$MySQLi = mysqli_connect($domain, $username, $password, $database);
      $hasil = json_decode($_POST['namanya'],true);
      // print_r($hasil);
      $insertnilai='INSERT INTO NilaiMahasiswa (KodeNilai,NRP,Nilai,KodeNisbi) VALUES ';
      foreach ($hasil['Data'] as $key => $value) {
         if ($value['nilai'] != "Tidak hadir")
         {
            if ($value['nilai'] >= 81 && $value['nilai'] <= 100)
            {
                        $KodeNisbi = "A";
            }
            else if ($value['nilai'] >= 73 && $value['nilai'] < 81)
            {
                        $KodeNisbi = "AB";
            }
            else if ($value['nilai'] >= 66 && $value['nilai'] < 73)
            {
                        $KodeNisbi = "B";
            }
            else if ($value['nilai'] >= 60 && $value['nilai'] < 66)
            {
                        $KodeNisbi = "BC";
            }
            else if ($value['nilai'] >= 55 && $value['nilai'] < 60)
            {
                        $KodeNisbi = "C";
            }
            else if ($value['nilai'] >= 40 && $value['nilai'] < 55)
            {
                        $KodeNisbi = "D";
            }
            else if ($value['nilai'] >= 0 && $value['nilai'] < 40)
            {
                        $KodeNisbi = "E";
            }
            $insertnilai.='("'.$hasil['KodeNilai'].'","'.$value['nrp'].'","'.$value['nilai'].'","'.$KodeNisbi.'"),';
         }
      }
      $insertnilai = rtrim($insertnilai,",");
      $updatenilai='UPDATE NILAI SET STATUS ="Daftar" WHERE KodeNilai = "'.$hasil['KodeNilai'].'"';
      // echo $hasil['KodeNilai'];
      if ($MySQLi->query($insertnilai) === TRUE) {
         // echo "New record created successfully";
      } else {
          echo "Error: " . $insertnilai . " -- " . $MySQLi->error;
      }
      if ($MySQLi->query($updatenilai) === TRUE) {
         // echo "New record created successfully";
      } else {
          echo "Error: " . $updatenilai . " -- " . $MySQLi->error;
      }
      mysqli_close($MySQLi);
      echo "SUKSES";
   }
}
new Upload();
?>
