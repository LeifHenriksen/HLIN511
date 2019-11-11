<?php
session_start();
if (isset($_GET['deconnexion'])) {
		session_unset();
		header("location:login.php");
	}
else if($_SESSION['username'] !== ""){
$user = $_SESSION['username'];
$user_type =		$_SESSION['user_type'];
switch ($user_type) {
	case '0':
		$acess_type="utilisateur";
		break;
	case '1':
	$acess_type="administrateur";
	break;
	case '2':
		$acess_type="contributeur";
		break;
	default:
		# code...
		break;
}
 echo "Bonjour $user, vous êtes connecté(e) en tant que $acess_type";
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="get">
	<input type="submit" name="deconnexion" value="Se déconnecter">
</form>
</body>
</html>	