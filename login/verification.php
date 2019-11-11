<?php
session_start();
if (isset($_POST['nom']) && isset($_POST['mdp'])) {
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


    $user=$_POST['nom'];
    $mdp=$_POST['mdp'];
		
	if($mdp!="" && $user!="") {
		$requete = "SELECT COUNT(*) as test FROM utilisateur where 
              nom = '".$user."' and id = '".$mdp."' ";
        foreach  ($conn->query($requete) as $row) {
   		 print $row['test'] . "\t";
    }
    if($row['test']!=0) // nom d'utilisateur et mot de passe corrects
        {
        	$sql="SELECT user_type from utilisateur where  nom = '".$user."' and id = '".$mdp."' ";
        	foreach ($conn->query($sql) as $value) {
        		print $value['user_type'] . "\t";
        	}
        	if ($value['user_type']==0) {
           $_SESSION['username'] = $user;
           	$_SESSION['user_type']=$value['user_type'];
           header('Location: principale.php');
       }
       else if ($value['user_type']==1){
       	$_SESSION['username']=$user;
       		$_SESSION['user_type']=$value['user_type'];
       header('Location: principale.php');
   }
   		 else if ($value['user_type']==2){
       	$_SESSION['username']=$user;
       	$_SESSION['user_type']=$value['user_type'];
       header('Location: principale.php');

        }
    }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}


?>