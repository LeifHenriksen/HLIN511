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
<header>
<title>Table Evenements</title>
<link rel="StyleSheet" href="exo10.css">
</header>
<body>
<h1>Table Evenements</h1>

<?php 			//serveur   nombase   username   motdepasse
    $bdd = new DataBase("localhost","HLIN511","omvadmin","openmediavault");
    $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF FROM EVENEMENT";
    $resultat = $bdd->getPDO()->query($sql);
    Table::printTableButton("EVENEMENTS","Inscription",$resultat);
?>

</body>
</html>
