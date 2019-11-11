<?php 
    include 'pdo.php';
?>
<html>
<header>
    <title>PDO</title>
    <link rel="StyleSheet" href="exo10.css">
</header>
<body>
<h1>PDO<h1>
<?php 			//serveur   nombase   username   motdepasse
    $mon_pdo = new_pdo("localhost","HLIN511","omvadmin","openmediavault");
    if($mon_pdo == null)
    {
        echo 'ERREUR! avec le PDO';
        echo '<br>';
    }
    else
    {
	if(true)
        {
            
            $sql = "SELECT NOM_EVENT, ADRESSE, THEME, DATE_EV, DESCRIPTIF FROM EVENEMENT";
            $resultat = $mon_pdo->query($sql);
            print_table("EVENEMENTS",$resultat); 
        }
        else
        {
            echo 'Erreur, manque de attributs <br>';
        }
    }
?>
</body>
</html>
