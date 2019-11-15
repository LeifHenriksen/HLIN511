<?php
session_start();
include '../bdd_class/bdd_class.php';
include 'table_class.php';
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
    
    $bdd = new DataBase("localhost","HLIN511","omvadmin","openmediavault");
    switch($_GET["nom_table"])
    {
     case "EVENEMENTS":
         $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF FROM EVENEMENT";
         $resultat = $bdd->getPDO()->query($sql);
         Table::printTableButton("EVENEMENTS","Inscription",$resultat);
         break;
     case "CONTRIBUTEURS":
        $sql = "SELECT ID, NOM FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 2";
        $resultat = $bdd->getPDO()->query($sql);
        Table::printTableButton("CONTRIBUTEURS","Supprimer",$resultat);
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
