<?php
    class User
    {
        private $username;
        private $user_id;
        private $user_type;
        private $loggedin;
        
        function __construct($username, $password, $bdd, $loggedin)
        {
            if(!$loggedin || $loggedin == NULL)
            {
                $this->login($username, $password, $bdd);
            }
            else
            {
                $this->user_id   = $_SESSION["user_id"];
                $this->username  = $_SESSION["username"];
                $this->user_type = $_SESSION["user_type"];;
                $this->loggedin  = true;
            }
        }

        function login($username, $password, $bdd)
        {
            if($password!="" && $username!="")
            {
                $requete = "SELECT COUNT(*) as test 
                            FROM UTILISATEUR 
                            WHERE                     
                            nom = '".$username."' and mdp = '".$password."' ";
        
                foreach ($bdd->getPDO()->query($requete) as $row);

                if($row['test']!=0)
                {
                    $this->username = $username;

                    $sql="SELECT ID, TYPE_UTILISATEUR from UTILISATEUR where  nom = '".$username."' and mdp = '".$password."' ";
                    
                    $bdd->getPDO()->query($sql);
                    
                    foreach ($bdd->getPDO()->query($sql) as $value);
                    
                    $this->user_type = $value['TYPE_UTILISATEUR'];
                    $this->user_id   = $value['ID'];
                    $this->loggedin  = true;
                }
                else
                {
                    $this->loggedin = false;
                    header('Location: login.php?erreur=1');
                }
            }
            else
            {
                $this->loggedin = false;
                header('Location: login.php?erreur=2');
            }
        }
        function getUserName(){return $this->username;}
        function getUserType(){return $this->user_type;}
        function isLoggedIn (){return $this->loggedin;}
        function gotoHome   (){header('Location: principale.php');}

        function initSession()
        {
            $_SESSION['user_id']  = $this->user_id;
            $_SESSION['username'] = $this->username;
            $_SESSION['user_type']= $this->user_type;
            $_SESSION['loggedin'] = true;
        }

        function supprimerContributeur($id_contributeur, $bdd)
        {
            if($this->user_type == 1)
            {
                $sql="DELETE FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 2 AND ID = $id_contributeur;";
                $bdd->getPDO()->query($sql);
            }
            else
            {
                echo "Vous n'est pas admin";
            }
        }

        function inscription($id_evenement, $bdd)
        {
            $sql="INSERT INTO VISITE VALUES (".$this->user_id.",$id_evenement);";
            $bdd->getPDO()->query($sql);
        }
    }
?>
