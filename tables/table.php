<?php
session_start();
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
if(isset($_GET["nom_table"]))
{
    echo '<header>';
    echo '<title>'.$_GET["nom_table"].'</title>';
    echo '<link rel="StyleSheet" href="exo10.css">';
    echo '</header>';
    echo '<body>';
    echo '<h1>'.$_GET["nom_table"].'</h1>';
    
    $bdd = new DataBase();
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
</body>
</html>
