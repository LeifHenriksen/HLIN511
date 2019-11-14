<?php
session_start();
if (isset($_POST['nom']) && isset($_POST['mdp']))
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


    $user=$_POST['nom'];
    $mdp=$_POST['mdp'];
    
    if($mdp!="" && $user!="")
    {
        $requete = "SELECT COUNT(*) as test FROM UTILISATEUR where 
              nom = '".$user."' and mdp = '".$mdp."' ";
        foreach  ($conn->query($requete) as $row)
        {
            print $row['test'] . "\t";
        }

        if($row['test']!=0) // nom d'utilisateur et mot de passe corrects
        {
        	$sql="SELECT TYPE_UTILISATEUR from UTILISATEUR where  nom = '".$user."' and mdp = '".$mdp."' ";
            $_SESSION['loggedin'] = true;
        	foreach ($conn->query($sql) as $value)
            {
        		print $value['TYPE_UTILISATEUR'] . "\t";
        	}
        	if ($value['TYPE_UTILISATEUR']=='0')
            {
                $_SESSION['username'] = $user;
                $_SESSION['user_type']=$value['TYPE_UTILISATEUR'];
                header('Location: principale.php');
            }
            else if ($value['TYPE_UTILISATEUR']=='1')
            {
                $_SESSION['username']=$user;
                $_SESSION['user_type']=$value['TYPE_UTILISATEUR'];
                header('Location: principale.php');
            }
            else if ($value['TYPE_UTILISATEUR']=='2')
            {
                $_SESSION['username']=$user;
                $_SESSION['user_type']=$value['TYPE_UTILISATEUR'];
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
