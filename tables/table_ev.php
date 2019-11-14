<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
    //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} 
else 
{
    header('Location: ../login/login.php');
}
include 'affichage_table.php';
?>
<html>
<header>
<title>Table Evenements</title>
<link rel="StyleSheet" href="exo10.css">
</header>
<body>
<h1>Table Evenements</h1>
<?php 			//serveur   nombase   username   motdepasse
        
        $mon_pdo = new_pdo("localhost","HLIN511","omvadmin","openmediavault");
if($mon_pdo == null)
{
    echo 'ERREUR! avec le PDO';
    echo '<br>';
}
else
{
    $sql = "SELECT NOM_EVENT, ADRESSE, THEME, DATE_EV, DESCRIPTIF FROM EVENEMENT";
    $resultat = $mon_pdo->query($sql);
    print_table("EVENEMENTS",$resultat); 
}
?>
</body>
</html>
