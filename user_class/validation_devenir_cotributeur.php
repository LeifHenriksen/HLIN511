<?php
session_start();
include '../bdd_class/bdd_class.php';
if (isset($_POST['motivation']))
     {
        if(!empty($_SESSION['username']) && $_SESSION['user_type'] == 0)
        {
            $bdd = new DataBase();
            $sql="
            INSERT INTO DEMANDE_CONTRIBUTEUR
            VALUES 
            (".$_SESSION['user_id'].",'".$_POST['motivation']."');";

            try
            {
                $bdd->getPDO()->query($sql);
            }
            catch(PDOException $e)
            {
                echo 'Vous avez déjà une demande en cours';
                /*
                echo "Erreur avec la requete : " . $e->getMessage();
                echo '<br>';
                echo $sql;*/
            }

            if(!isset($e)){
                echo '<div class="alert alert-danger" role="alert">
                        Demande envoyé!
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
