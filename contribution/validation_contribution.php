<?php
session_start();
include '../bdd_class/bdd_class.php';
if (isset($_POST['nomEV']) && isset($_POST['adresse'])
 && isset($_POST['date']) && isset($_POST['effectif'])   
 && isset($_POST['Descriptif']) && isset($_POST['longitude'])
 && isset($_POST['latitude']))
     {
        if(!empty($_SESSION['username']) && $_SESSION['user_type'] > 0)
        {
            $bdd = new DataBase();
            $sql="INSERT INTO EVENEMENT VALUES (".$_POST['nomEV'].", 
            ".$_POST['adresse']   .", ".$_POST['longitude'].", 
            ".$_POST['latitude'].", ".$_POST['theme'].")".
              $_POST['date'].", ".$_POST['descriptif'].", ".$_POST['effectif'].", '0');";
            
            $query = $bdd->getPDO()->prepare($sql);
            $query->execute();
        }
        else
        {
            //header('Location: ../login/login.php');
            var_dump($_SESSION['username']);
            var_dump($_SESSION['user_type']);
        }
    }
    else
    {
        echo 'error';
    }
?>
