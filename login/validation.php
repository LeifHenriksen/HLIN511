<?php
if (isset($_POST['login']) && isset($_POST['mdp']))
{
    $servername = "localhost";
    $username = "omvadmin";
    $password = "openmediavault";
    
    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=HLIN511", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
    
    $user=$_POST['login'];
    $mdp=$_POST['mdp'];
	
	if($mdp!="" && $user!="")
    {
        $conn->exec("INSERT INTO UTILISATEUR(nom,mdp,TYPE_UTILISATEUR) VALUES ('".$user."','".$mdp."',0)");
        echo "Vous avez bien reussi votre inscritpion";
        header('Location: login.php');
    }
}
?>
