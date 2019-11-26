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
