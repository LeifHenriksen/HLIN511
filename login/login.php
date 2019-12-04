<?php
session_start();
if (!(empty($_SESSION['username']))) 
{
    header('Location: ../login/principale.php');
} 
?>
<!DOCTYPE html>
<html class ="bg">
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-12 col-sm-6 col-md-3">
				<form id="form1" class="form-container" method="post"  action="verification.php" >
				<div class="form-group">
					<label for="inputLogin">Nom d'utilisateur</label>
					<input type="text" class="form-control" name="nom" id="inputLogin" placeholder="Entrez votre nom d'utilisateur">
				</div>
				<div class="form-group">
					<label for="inputPassword">Mot de Passe</label>
					<input type="password" class="form-control" id="inputPassword" name="mdp" placeholder="Mot de passe">
				</div>
				<button type="submit" class="btn btn-primary btn-block" name="test">Connexion</button>
				<br>
					<a href="inscription.html" >Nouvel utilisateur ? 
											Créer un compte</a>
			</form>
			</section>
		</section>
	</section>
	<?php
if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
