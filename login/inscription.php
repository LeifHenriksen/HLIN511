<?php
session_start();
include '../bdd_class/bdd_class.php';

if (isset($_POST['login']) && isset($_POST['mdp']))
     {
      
            //Vérif 
      $mdpv=$_POST['mdp2'];
        if($mdpv!=$_POST['mdp']){ $nameErr="Les mots de passe ne correspondent pas!";} 
            $login=$_POST['login'];
            $bdd = new DataBase();
            $verif="SELECT count(*) as test from UTILISATEUR where NOM like '%$login%'";
           foreach ($bdd->getPDO()->query($verif) as $row);

                if($row['test']!=0)
                {
                  $nameErr="Nom d'utilisateur déjà pris...";
              
               }  else {
                  $user=$_POST['login'];
    $mdp=$_POST['mdp'];
  
  if($mdp!="" && $user!="" && $mdpv==$_POST['mdp'])
    {
      $nameErr="";
            $sql="INSERT INTO UTILISATEUR(nom,mdp,TYPE_UTILISATEUR,age) VALUES ('".$user."','".$mdp."',0,40)";

            try
            {
                $bdd->getPDO()->query($sql);
            }
            catch(PDOException $e)
            {
                echo "Erreur avec la requete : " . $e->getMessage();
                echo '<br>';
            //    echo $sql;
            }

            if(!isset($e)){
                echo '<div class="alert alert-danger" role="alert">
  Vous etes bien inscrit !
</div>';
//header('Location: ../login/principale.php');
        }
        }
      
       
  }
}

?>
<!DOCTYPE html>
<html class="bg">
  <head>
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="utf-8"/>
  </head>
  <body>
 <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-3">
        <form id="form1" class="form-container" method="post"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        <div class="form-group">
          <label for="inputLogin">Choisissez votre nom d'utilisateur</label>
          <input type="text" class="form-control" name="login" id="inputLogin" placeholder="Entrez votre nom d'utilisateur"  required>
          
        </div>
        <div class="form-group">
          <label for="inputPassword">Choisissez un mot de passe</label>
          <input type="password" class="form-control" id="inputPassword" name="mdp" placeholder="Mot de passe" required>
        </div>
         <div class="form-group">
          <label for="inputPassword">Confirmer votre mot de passe</label>
          <input type="password" class="form-control" id="inputPassword" name="mdp2" placeholder="Mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="test">S'inscrire</button>
        <br>
        <span class="error"><?php if ($nameErr) {
         echo $nameErr;}?></span> 
      </form>
      </section>
    </section>
  </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
