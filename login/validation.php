<?php
if (isset($_POST['login']) && isset($_POST['mdp'])) {
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    $user=$_POST['login'];
    $mdp=$_POST['mdp'];
		
	if($mdp!="" && $user!="") {
	 $conn->exec("INSERT INTO utilisateur(nom,id,user_type) VALUES ('".$user."','".$mdp."',0)");
     echo "Vous avez bien reussi votre inscritpion";
 }
}
 ?>
   