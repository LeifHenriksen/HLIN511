<?php
session_start();
include '../bdd_class/bdd_class.php';
if (isset($_POST['nom_theme']))
     {
        if(!empty($_SESSION['username']) && $_SESSION['user_type'] == 1)
        {
            $bdd = new DataBase();
            if(!isset($_POST['theme_pere']))
            	$sql="
            	INSERT INTO THEME VALUES
            	('".$_POST['nom_theme']."',
             	'".$_POST['theme_pere']."',
             	(SELECT THEME_RACINE FROM THEME T WHERE T.NOM_THEME LIKE '".$_POST['theme_pere']."'))";
             else
               $sql="
            	INSERT INTO THEME VALUES
            	('".$_POST['nom_theme']."', NULL, NULL)";
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
                         Theme ajouté !
                      </div>';
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
?>
