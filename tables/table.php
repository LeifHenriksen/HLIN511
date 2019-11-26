<!DOCTYPE html>
<html>
<head>
<title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="../login/style2.css">
</head>
<body>
<?php
session_start();
if (isset($_GET['deconnexion']))
{
    session_unset();
    header("Location: ../login/login.php");
}
include '../bdd_class/bdd_class.php';
include 'table_class.php';
include '../user_class/user_class.php';
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])) 
{
    header('Location: ../login/login.php');
} 

?>
<html>
<?php
    $bdd = new DataBase();
   $ActualUser= new User($_SESSION['username'], null, $bdd,$_SESSION['loggedin']);
    $user      = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];
    $acess_type = '';
    $ActualUser->printNavBar($user_type);
if(isset($_GET["nom_table"]))
{
    echo '<header>';
    echo '<title>'.$_GET["nom_table"].'</title>';
    echo '<link rel="StyleSheet" href="exo10.css">';
    echo '</header>';
    echo '<body>';
    echo '<h1 class="display-1">'.$_GET["nom_table"].'</h1>';
    
    $user = new User(NULL,NULL,NULL,true);

    switch($_GET["nom_table"])
    {
    case "EVENEMENTS":
        if(isset($_GET["Inscription"]))
        {
            $user->inscription($_GET["Inscription"], $bdd);
        }
        
        $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF FROM EVENEMENT";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("EVENEMENTS","Inscription",$resultat);
        //Table::printTableBis();
        break;
    case "CONTRIBUTEURS":
        if(isset($_GET["Supprimer"]))
        {
            $user->supprimerContributeur($_GET["Supprimer"],$bdd);
        }
        //aficher seulement si user_type == admin
        $sql = "SELECT ID, NOM FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 2";
        $resultat = $bdd->getPDO()->query($sql);
       Table::printTableButton("CONTRIBUTEURS","Supprimer",$resultat);
       // Table::printTableBis();
        break;
    case "VISITE":
        $sql = "SELECT * FROM VISITE";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTable("VISITE", $resultat);
        break;
    case "SUP_EVENEMENTS":
        if(isset($_GET["Supprimer"]))
        {
            $user->supprimer_evenement($_GET["Supprimer"], $bdd);
        }
        //aficher seulement si user_type == admin
        $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF FROM EVENEMENT";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("SUP_EVENEMENTS","Supprimer",$resultat);
        break;
    case "MES_EVENEMENTS":
        if(isset($_GET["Supprimer_inscription"]))
        {
            $user->supprimer_inscription($_GET["Supprimer_inscription"], $bdd);
        }
        
        $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF 
                FROM EVENEMENT E, VISITE V
                WHERE E.ID_EVENT = V.ID_EV
                AND V.ID_VISITEUR =".$user->getUserID().";";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("MES_EVENEMENTS","Supprimer_inscription",$resultat);
        break;
    case "UTILISATEURS":
        if(isset($_GET["Convertir_en_contributeur"]))
        {
            $user->ajouter_contributeur($_GET["Convertir_en_contributeur"],$bdd);
        }
        //aficher seulement si user_type == admin
        $sql = "SELECT ID, NOM FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 0";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("UTILISATEURS","Convertir_en_contributeur",$resultat);
        break;
    case "SUP_UTILISATEURS":
        if(isset($_GET["Supprimer_utilisateur"]))
        {
            $user->supprimer_utilisateur($_GET["Supprimer_utilisateur"],$bdd);
        }
        //aficher seulement si user_type == admin
        $sql = "SELECT ID, NOM FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 0";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("SUP_UTILISATEURS","Supprimer_utilisateur",$resultat);
        break;
    case "MES_CONTRIBUTIONS":
        //aficher seulement si user_type == admin || contributeur
         echo 'a faire';
        break;
    default:
        echo 'Table non trouve';
    }
}
else
{
    echo 'Table non trouve';
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 

