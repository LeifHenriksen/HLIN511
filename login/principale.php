<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php
function print_lien($value, $page)
{
    echo "<form method='get' action=$page><input type='submit' value=$value></form>";
}
function print_lien_table($value, $page, $nomtable)
{
    echo "<form method='get' action=$page><input type='hidden' name='nom_table' value=$nomtable><input type='submit' value=$value></form>";
}
session_start();
if (isset($_GET['deconnexion']))
{
    session_unset();
    header("location:login.php");
}
else if($_SESSION['username'] !== "")
{
    $user      = $_SESSION['username'];
    $user_type = $_SESSION['user_type'];
    $acess_type = '';
    switch ($user_type)
    {
    case 0:
        $acess_type="utilisateur";
        echo "Bonjour $user, vous êtes connecté(e) en tant que $acess_type.";
        echo'<form method="get"><input type="submit" name="deconnexion" value="Se déconnecter"></form>';
        print_lien_table("'Table de Evenements'", '../tables/table.php',"EVENEMENTS");
		break;
    case 1:
        $acess_type="administrateur";
        echo "Bonjour $user, vous êtes connecté(e) en tant que $acess_type.";
        echo'<form method="get"><input type="submit" name="deconnexion" value="Se déconnecter"></form>';
        print_lien_table("'Table de Evenements'", '../tables/table.php',"EVENEMENTS");
        print_lien("'Creer/Supprimer des evenements'", '../login/contribution.php');
        print_lien_table("'Table de contributeurs'", '../tables/table.php',"CONTRIBUTEURS");
        print_lien_table("'Table de visiteurs'", '../tables/table.php',"VISITE");
        print_lien("'Table de themes'", '../index.php');
        break;
    case 2:
        $acess_type="contributeur";
        echo "Bonjour $user, vous êtes connecté(e) en tant que $acess_type.";
        echo'<form method="get"><input type="submit" name="deconnexion" value="Se déconnecter"></form>';
        print_lien_table("'Table de Evenements'", '../tables/table.php',"EVENEMENTS");
        print_lien("'Creer/Supprimer des evenements'", '../login/contribution.php');
        print_lien_table("'Table de visiteurs'", '../tables/table.php',"VISITE");
        break;
    default:
        echo 'erreur';
        break;
    }
}
?>
</body>
</html>	
