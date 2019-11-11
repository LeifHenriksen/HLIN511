<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style.css" />
    <meta charset="utf-8" />
</head>
<body>
<div id="container">
<form method="post" action="verification.php" >
	<input type="text" name="nom" placeholder="Adresse email ou nom d'utilisateur">
	<br>
	<br>	
	<input type="password" name="mdp" placeholder="Mot de passe">
	<br>
	<br>
	<input  type="submit" name="test" value="Se connecter">
	<br>
	<br>
	<a href="inscription.php" >New user? Sign in</a>
<?php
if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
?>
</form>
</div>
</body>
</html>