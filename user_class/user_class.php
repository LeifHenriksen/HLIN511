<?php
    class User
    {
        private $username;
        private $user_type;
        private $loggedin;
        
        function __construct($username, $password, $bdd)
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

                    $sql="SELECT TYPE_UTILISATEUR from UTILISATEUR where  nom = '".$username."' and mdp = '".$password."' ";
                    
                    $bdd->getPDO()->query($sql);
                    
                    foreach ($bdd->getPDO()->query($sql) as $value);
                    
                    $this->user_type = $value['TYPE_UTILISATEUR'];
                    var_dump($this->user_type);
                    $this->loggedin = true;
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
            $_SESSION['username'] = $this->username;
            $_SESSION['user_type']= $this->user_type;
            $_SESSION['loggedin'] = true;
        }
    }
?>