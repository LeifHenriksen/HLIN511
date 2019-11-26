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
            $bdd = new DataBase();
            $sql="
            INSERT INTO EVENEMENT (NOM_EVENT, ADRESSE, 
                                   LONGITUDE, LATITUDE, 
                                   THEME, DATE_EV, DESCRIPTIF, 
                                   EFFECTIF_MAX, EFFECTIF_MIN)
            VALUES 
           ('".$_POST['nomEV']  ."','".$_POST['adresse']."'
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

            if(!isset($e))
                echo "Evenement ajouté.";
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
