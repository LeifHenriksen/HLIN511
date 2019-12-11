<?php 
session_start();
if (isset($_SESSION['loggedin']))
{
    header('Location: login/principale.php');
}   
else 
{
    header('Location: login/guest.php');
}
?>
