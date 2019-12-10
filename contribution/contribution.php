<?php
session_start();
include '../bdd_class/bdd_class.php';
if (isset($_POST['nomEV'])      && isset($_POST['adresse'])
 && isset($_POST['date'])       && isset($_POST['effectif_max'])   
 && isset($_POST['descriptif']) && isset($_POST['longitude'])
 && isset($_POST['latitude'])   && isset($_POST['theme'])
 && isset($_POST['effectif_min']))
     {
        if(!empty($_SESSION['username']) && $_SESSION['user_type'] > 0)
        {
            //Vérif 
            $nomEV=$_POST['nomEV'];
            $bdd = new DataBase();
            $verif="SELECT count(*) as test from Evenement where NOM_EVENT like '%$nomEV%'";
           foreach ($bdd->getPDO()->query($verif) as $row);

                if($row['test']!=0)
                {
                  $nameErr='Déjà pris...';
             }
            else {
            $sql="
            INSERT INTO EVENEMENT (ID_CREATEUR, NOM_EVENT, ADRESSE, 
                                   LONGITUDE, LATITUDE, 
                                   THEME, DATE_EV, DESCRIPTIF, 
                                   EFFECTIF_MAX, EFFECTIF_MIN)
            VALUES 
           (".$_SESSION['user_id'].",'".$_POST['nomEV']  ."','".$_POST['adresse']."'
            ,".$_POST['longitude'].",".$_POST['latitude'].",
            '".$_POST['theme']."','"   .$_POST['date']."', 
            '".$_POST['descriptif']."',".$_POST['effectif_max']."
            ,".$_POST['effectif_min'].");";

            try
            {
                $bdd->getPDO()->query($sql);
            }
            catch(PDOException $e)
            {
                echo "Erreur avec la requete : " . $e->getMessage();
                echo '<br>';
                echo $sql;
            }

            if(!isset($e)){
                echo '<div class="alert alert-danger" role="alert">
  Evenement ajouté !
</div>';
//header('Location: ../login/principale.php');
        }
        }
      }
        else
        {
            header('Location: ../login/login.php');
        }
    }
    else
    {
        var_dump($_POST);
        echo 'error';
    }


include '../user_class/user_class.php';

if (isset($_GET['deconnexion']))
{
    header("location:../login/logout.php");
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
        <form id="bg"class="form-container" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="width: 100%;" >
        <div class="form-group">
          <label for="inputNomEvent">Nom de l'évènement</label>
          <input type="text" class="form-control" name="nomEV" id="inputNomEvent" placeholder="Entrez le nom de l'évènement" value="<?php echo htmlspecialchars($nomEV);?>"required>
<span class="error"><?php echo $nameErr;?></span> 
        </div>
        <div class="form-group">
          <label >Adresse</label>
          <input type="text" class="form-control" name="adresse" placeholder="51 rue des lilas" required>
        </div>
        <div class="form-group">
          <label >Latitude</label>
          <input type="text" class="form-control" name="latitude" placeholder="3.46" required>
        </div>
          <div class="form-group">
          <label for="latitude">Longitude </label>
         <input  class="form-control" name="longitude" type="text" placeholder="43.65" required>
       </div>
        <div class="form-group">
          <label >Date de l'évènement</label>
         <input type="date"  class="form-control" name="date" type="text" placeholder="aaaa-mm-jj" required>
       </div>
       <div class="form-group">
          <label >Theme</label>
          <input type="text" class="form-control" name="theme" placeholder="Historique" onkeyup="showHint(this.value,'THEME','NOM_THEME')" required>
        </div>
       <p>Suggestions: <span id="txtHint"></span></p>
       <div class="form-group">
          <label >Descriptif de l'évènement</label>
         <input  class="form-control" name="descriptif" type="text" placeholder="rgzegrtheyhej" required>
       </div>
       <div class="form-group">
          <label >Effectif maximum</label>
          <input type="text" class="form-control" name="effectif_max" placeholder="50" required>
        </div>
       <div class="form-group">
          <label >Effectif minimum</label>
          <input type="text" class="form-control" name="effectif_min" placeholder="50" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="test">Créer l'évènement</button>
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


