<?php
session_start();

include '../bdd_class/bdd_class.php';
include '../user_class/user_class.php';

if (isset($_POST['nom']) && isset($_POST['mdp']))
{
    $bdd = new DataBase();
    $user = new User($_POST['nom'], $_POST['mdp'], $bdd,$_SESSION['loggedin']);
    if($user->isLoggedIn())
    {
        $user->initSession();
        $user->gotoHome();
    }
}
else
{
    header('Location: login.php');
}
?>
