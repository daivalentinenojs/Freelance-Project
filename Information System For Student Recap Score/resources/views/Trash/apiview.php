<?php


class API {
    function API (){

    require "init.php";
    $mysqli = mysqli_connect($domain, $username, $password, $database);
    if((isset($_GET['Email']) || isset($_GET['Password'])) && isset($_GET['Tipe']))
    {
        $EmailInput = $_GET['Email'];
        $PasswordInput = $_GET['Password'];

        if($_GET['Tipe'] == 1)
        {
            $this->Login($EmailInput, $PasswordInput, $mysqli);
        }

    }
  }

  function Login($Email, $Password, $mysqli)
  {
    $query = "SELECT Count(User.ID) AS 'Jumlah', User.ID AS IDDB, User.Password AS PasswordDB FROM User WHERE User.Email = '$Email' AND User.Password = '$Password' AND User.Status = 1 GROUP BY User.ID, User.Password";
    $result = mysqli_query($mysqli,$query);
    $rows = array();
    while($r = mysqli_fetch_assoc($result)){
      $rows[] = $r;
    }
    echo json_encode($rows);


  }

  function Post()
  {

  }
}
$tes = new API();
//$tes->Login($_GET["Email"], $_GET["Password"]);
?>
