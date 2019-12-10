<?php
include '../user_class/user_class.php';
include '../bdd_class/bdd_class.php';

session_start();
if (isset($_GET['deconnexion']))
{
    header("location:../login/logout.php");
}
else if($_SESSION['username'] != "" && $_SESSION['user_type'] == 1)
{

    $bdd = new DataBase();
    $ActualUser= new User($_SESSION['username'], null, $bdd,$_SESSION['loggedin']);
    $user      = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];
    $ActualUser->printNavBar($user_type);
}
else
{
    header("location:../login/logout.php");
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
        <form id="bg"class="form-container" method="post"  action="../contribution/valider_theme.php" style="width: 100%;" >
        <div class="form-group">
          <label for="inputNomEvent">Theme père</label>
          <input type="text" class="form-control" name="theme_pere" id="theme_pere" placeholder="SPORTS" onkeyup="showHint(this.value,'THEME','NOM_THEME')">
          </div>
          <div class="form-group">
           <label >Nom theme</label>
          <input  class="form-control" name="nom_theme" type="text" placeholder="Ski" onkeyup="showHint(this.value,'THEME','NOM_THEME')"/>
         </div>
         <div class="alert alert-success" role="alert">
          <p>Suggestions: <span id="txtHint"></span></p>
        <button type="submit" class="btn btn-primary btn-block" name="test">Ajouter theme</button></div>
      </form>
      </section>
    </section>
  </section>
  <script src='../scripts/autocomplete.js'></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


