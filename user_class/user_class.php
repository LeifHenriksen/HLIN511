<?php
    class User
    {
        private $username;
        private $user_id;
        private $user_type;//0 = utilisateur, 1 = admin, 2 = contribuiteur
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
                $this->user_type = $_SESSION["user_type"];
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

                    $sql="SELECT MDP,ID, TYPE_UTILISATEUR from UTILISATEUR where  nom = '".$username."' and mdp = '".$password."' ";
                    
                    $bdd->getPDO()->query($sql);
                    
                    foreach ($bdd->getPDO()->query($sql) as $value);
                    
                    $this->user_type = $value['TYPE_UTILISATEUR'];
                    $this->user_id   = $value['ID'];
                    $this->password=$value['MDP'];
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
        function getUserID  (){return $this->user_id;}
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
            
            try 
            {
                $bdd->getPDO()->query($sql);    
            }
            catch( PDOException $Exception ) 
            {
                //23000 == primary key constraint    
                if($Exception->getCode() == 23000)
                {
                    echo '<div class="alert alert-danger" role="alert">
  Vous êtes déjà inscrit à cet événement!
</div>';
                }
            }
            
        }

        function ajouter_contributeur($id_utilisateur, $bdd)
        {
            if($this->user_type == 1)
            {
                $sql="UPDATE UTILISATEUR SET TYPE_UTILISATEUR = 2 WHERE ID = $id_utilisateur;";
                $bdd->getPDO()->query($sql);
            }
            else
            {
                echo "Vous n'est pas admin";
            }
        }

        function supprimer_demande_contributeur($id_utilisateur, $bdd)
        {
            if($this->user_type == 1)
            {
                $sql="DELETE FROM DEMANDE_CONTRIBUTEUR WHERE ID_UTILISATEUR = $id_utilisateur;";
                $bdd->getPDO()->query($sql);
            }
            else
            {
                echo "Vous n'est pas admin";
            }
        }
        
        function supprimer_evenement($id_evenement, $bdd)
        {
            if($this->user_type > 0)
            {
                $sql="DELETE FROM VISITE WHERE ID_EV = $id_evenement;";
                $bdd->getPDO()->query($sql);
                $sql="DELETE FROM EVENEMENT WHERE ID_EVENT = $id_evenement;";
                $bdd->getPDO()->query($sql);
            }
            else
            {
                echo "Vous n'est pas admin";
            }
        }
        function supprimer_inscription($id_evenement, $bdd)
        {
            $sql="DELETE FROM VISITE WHERE ID_EV = $id_evenement AND ID_VISITEUR = ".$this->user_id.";";
            $bdd->getPDO()->query($sql);
        }
        function supprimer_utilisateur($id_utilisateur, $bdd)
        {
            if($this->user_type == 1)
            {
                $sql="DELETE FROM UTILISATEUR WHERE TYPE_UTILISATEUR = 0 AND ID = $id_utilisateur;";
                $bdd->getPDO()->query($sql);
            }
            else
            {
                echo "Vous n'est pas admin";
            }
        }
        function supprimer_contribution($id_evenement, $bdd){}
        
        function printNavBar($user_type){
                switch ($user_type) {
                    case 0:
                    echo'<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
             <a class="nav-item nav-link active" href="../login/principale.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Évènements
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="nav-item nav-link" href="../tables/table.php?nom_table=EVENEMENTS">Liste des évènements</a>
         <a class="nav-item nav-link" href="../tables/table.php?nom_table=MES_EVENEMENTS">Mes Évènements</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link" href="../user_class/devenir_contributeur.php">Devenir contributeur</a>
      </li>
        <form method="get"><button type="submit" class="btn btn-danger" name="deconnexion" >Déconnexion</button></form>
    </ul>
  </div>
</nav>';
                    break;
                    case 1:
                     echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
             <a class="nav-item nav-link active" href="../login/principale.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Évènements
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="nav-item nav-link" href="../tables/table.php?nom_table=EVENEMENTS">Liste des évènements</a>
         <a class="nav-item nav-link" href="../tables/table.php?nom_table=MES_EVENEMENTS">Mes Évènements</a>
           <a class="nav-item nav-link" href="../tables/table.php?nom_table=SUP_EVENEMENTS">Supprimer des Évènements</a>
           <a class="nav-item nav-link" href="../map/map.php">Carte des évènements</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Contribution
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="nav-item nav-link" href="../contribution/contribution.php">Contribuer</a>
         <a class="nav-item nav-link" href="../tables/table.php?nom_table=MES_CONTRIBUTIONS">Mes Contributions</a>
          <a class="nav-item nav-link" href="../tables/table.php?nom_table=UTILISATEURS">Ajouter des contributeurs</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link" href="../tables/table.php?nom_table=SUP_UTILISATEURS">Supprimer des utilisateurs</a>
        </li>
        <form method="get"><button type="submit" class="btn btn-light" name="connecter">
        Se connecter </button></form>
        <form method="get"><button type="submit" class="btn btn-danger" name="deconnexion" >Déconnexion</button></form>
    </ul>
  </div>
</nav>';
                        
                        break;
                        case 2:
                            echo'<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
             <a class="nav-item nav-link active" href="../login/principale.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Évènements
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="nav-item nav-link" href="../tables/table.php?nom_table=EVENEMENTS">Liste des évènements</a>
         <a class="nav-item nav-link" href="../tables/table.php?nom_table=MES_EVENEMENTS">Mes Évènements</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Contribution
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="nav-item nav-link" href="../contribution/contribution.php">Contribuer</a>
         <a class="nav-item nav-link" href="../tables/table.php?nom_table=MES_CONTRIBUTIONS">Mes Contributions</a>
        </div>
      </li>
        <form method="get"><button type="submit" class="btn btn-danger" name="deconnexion" >Déconnexion</button></form>
    </ul>
  </div>
</nav>';
                            break;
                    default:
                        
                        break;
                }



        }
    }
?>
