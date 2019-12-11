<?php
session_start();
include '../bdd_class/bdd_class.php';
if(isset($_SESSION['username'])) 
{	
    $bdd = new DataBase();

    // get the q parameter from URL
    $note         = $_REQUEST["note"];
    $id_evenement = $_REQUEST["id_ev"];

    $sql = 'SELECT * FROM RATING WHERE ID_EV = '.$id_evenement.' AND ID_UTILISATEUR = '.$_SESSION['user_id'];
    $resultat = $bdd->getPDO()->query($sql);
    
    if($resultat->rowCount() <= 0)
    {
        $sql = 'INSERT INTO RATING VALUES ('.$id_evenement.','.$_SESSION['user_id'].','.$note.')';
        $bdd->getPDO()->query($sql);
    }
    else
    {
        $sql = 'UPDATE RATING SET NOTE = '.$note.' WHERE ID_EV = '.$id_evenement.' AND ID_UTILISATEUR = '.$_SESSION['user_id'];
        $bdd->getPDO()->query($sql);
    }
    //echo var_dump($_REQUEST);
}
?> 
