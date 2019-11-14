<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['user_type'] == 1) 
{
    
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
    $sql = "SELECT ID, NOM FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 2";
    $resultat = $mon_pdo->query($sql);
    print_table("CONTRIBUTEURS",$resultat); 
}
?>
</body>
</html>
