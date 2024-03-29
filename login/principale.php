<!DOCTYPE html>
<html>
<head>
<title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="style2.css">
      <meta name="viewport" content="width=device-width"/>
</head>
<body data-spy="scroll" data-targer="#navbarresponsive">
<?php
include '../user_class/user_class.php';
include '../bdd_class/bdd_class.php';

session_start();
if (isset($_GET['deconnexion']))
{
    session_unset();
    header("location:login.php");
}
else if($_SESSION['username'] != "")
{

    $bdd = new DataBase();
    $ActualUser= new User($_SESSION['username'], null, $bdd,$_SESSION['loggedin']);
    $user      = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];
    $acess_type = '';
    $ActualUser->printNavBar($user_type);
}
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img  class="d-block w-100" src="../images/dark_mountains.jpg" alt="First slide">
          <div class="carousel-caption text-center">
        <h1>Randonnée</h1>
        <a class="btn btn-outline-light btn-lg" href="../tables/table.php?nom_table=RANDONNEE">Voir</a>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../images/background-2.jpg" alt="Second slide">
        <div class="carousel-caption text-center">
        <h1>Ski</h1>
        <a class="btn btn-outline-light btn-lg"  href="../tables/table.php?nom_table=SKI">Voir</a>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../images/background3.jpg" alt="Third slide">
        <div class="carousel-caption text-center">
        <h1>Surf</h1>
        <a class="btn btn-outline-light btn-lg" href="../tables/table.php?nom_table=SURF">Voir</a>
    </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>	
