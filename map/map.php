<html >
  <head>  

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <link rel="stylesheet" type="text/css" href="../login/style2.css">
      <meta name="viewport" content="width=device-width"/>
    <script src="../login/jquery-3.4.1.js"></script>
    <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui.min.css"></link>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/build/ol.js"></script>    
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.0.1/css/ol.css"/>
    <style>
      .points_interet, .map { width: 100%; }
      .marker { display: none;
      margin-left: -25px;
      margin-top: -50px; }
    </style>

  </head>
  <body class="bg">
    <?php
include '../user_class/user_class.php';
include '../bdd_class/bdd_class.php';

session_start();
$bdd = new DataBase();
if (isset($_GET['deconnexion']))
{
   header("location:../login/logout.php");
}
else if(isset($_SESSION['username']))
{

    //$bdd = new DataBase();
    $ActualUser= new User($_SESSION['username'], null, $bdd,$_SESSION['loggedin']);
    $user      = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];
    $acess_type = '';
    $ActualUser->printNavBar($user_type);
}
else
{
    User::printNavGuest(); 
}
    $statement=$bdd->getPDO()->prepare("select NOM_EVENT,LATITUDE,LONGITUDE,DESCRIPTIF from EVENEMENT");
    $datas = array();
    if($statement->execute()) {
      $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $row);

        $datas = json_encode($res);
         
    } else {
        $datas = array();
        print_r($statement->errorInfo());
    }
  //  echo $datas;
    
    $fp = fopen('../map/events.json', 'w');
    //enlever les spaces
    fwrite($fp, json_encode($res));
   //  var_dump($res);
    fclose($fp);
?>
<div class="container-fluid">
  <br>
  <br>
  <br>
  <br>
    <div id="points_interet" class="points_interet" style="width:100%;"></div>
    <div id="map" class="map" style="width:100%; height:75%"></div>
    <img id="markerProto" class="marker" src="marker2.png" width="50" height="50"  />
    <div id="popupProto"  style="display:none; font-size:18pt; color:black; margin-left: -100px; margin-top: -110px"></div>
    </div>
    <script src="map.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

  </body>
</html>
