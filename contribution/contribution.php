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
<!DOCTYPE html>
<html>
<head>
  <title>Contribution</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../login/style2.css">
</head>
<body class="bg">
     <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-3">
        <form id="bg"class="form-container" method="post"  action="../contribution/validation_contribution.php" style="width: 100%;" >
        <div class="form-group">
          <label for="inputNomEvent">Nom de l'évènement</label>
          <input type="text" class="form-control" name="nomEV" id="inputNomEvent" placeholder="Entrez le nom de l'évènement">
        </div>
        <div class="form-group">
          <label >Adresse</label>
          <input type="text" class="form-control" name="adresse" placeholder="51 rue des lilas">
        </div>
        <div class="form-group">
          <label >Latitude</label>
          <input type="text" class="form-control" name="latitude" placeholder="3.46">
        </div>
          <div class="form-group">
          <label for="latitude">Longitude </label>
         <input  class="form-control" name="longitude" type="text" placeholder="43.65" />
       </div>
        <div class="form-group">
          <label >Date de l'évènement</label>
         <input  class="form-control" name="date" type="text" placeholder="aaaa-mm-jj" />
       </div>
       <div class="form-group">
          <label >Theme</label>
          <input type="text" class="form-control" name="theme" placeholder="Historique">
        </div>
       <div class="form-group">
          <label >Descriptif de l'évènement</label>
         <input  class="form-control" name="descriptif" type="text" placeholder="rgzegrtheyhej" />
       </div>
       <div class="form-group">
          <label >Effectif maximum</label>
          <input type="text" class="form-control" name="effectif_max" placeholder="50">
        </div>
       <div class="form-group">
          <label >Effectif minimum</label>
          <input type="text" class="form-control" name="effectif_min" placeholder="50">
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="test">Créer l'évènement</button>
      </form>
      </section>
    </section>
  </section>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


