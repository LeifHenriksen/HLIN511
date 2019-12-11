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
    $note_existe= $bdd->getPDO()->query($sql);

    $sql = 'SELECT * FROM EVENEMENT WHERE DATE_EV >= CURRENT_DATE() AND ID_EVENT = '.$id_evenement;
    $evenement_passe = $bdd->getPDO()->query($sql);
    
    if($note_existe->rowCount() <= 0 && $evenement_passe->rowCount()<= 0)
    {
        $sql = 'INSERT INTO RATING VALUES ('.$id_evenement.','.$_SESSION['user_id'].','.$note.')';
        $bdd->getPDO()->query($sql);
        echo '{"status" : true, "message" : "Note enregistre"}';
    }
    else if($evenement_passe->rowCount()<= 0)
    {
        $sql = 'UPDATE RATING SET NOTE = '.$note.' WHERE ID_EV = '.$id_evenement.' AND ID_UTILISATEUR = '.$_SESSION['user_id'];
        $bdd->getPDO()->query($sql);
        echo '{"status" : true, "message" : "Note enregistre"}';
        
    }
    else
    {
        echo '{"status" : false, "message" : "Cet événement n\'a pas encore eu lieu."}' ;
    }
    //echo var_dump($_REQUEST);
}
?> 
