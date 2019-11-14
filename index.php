<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
    header('Location: login/principale.php');
} 
else 
{
    header('Location: login/login.php');
}
?>
