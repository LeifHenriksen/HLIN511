<form action="validation.php" method="post">
          <legend>Etat civil :</legend>
         <label for="nom">Nom</label>
         <input id="nom" name="nom" type="text" /><br />
         <label for="prenom">Prénom </label>
         <input id="prenom" name="prenom" type="text" /><br />
         <label for="date-de-naissance">Date de naissance</label>
         <input id="date-de-naissance" name="date-de-naissance" type="text" placeholder="jj/mm/yyyy" />
   
          <legend>Adresse :</legend>
          <label>Rue</label>
          <input id="rue" name="rue" type="text" /><br />
          <label>Code postal</label>
          <input id="code-postal" name="code-postal" type="text" /><br />
          <label>Ville</label>
          <input id="ville" name="ville" type="text" />
          
          <legend>Choix des parametres de connexion :</legend>
          <label>Login</label>
          <input id="login" name="login" type="text" placeholder="jerems34" />
          <br>
          <label>Mot de passe</label>
          <input id="mdp" name="mdp" type="text" placeholder="" />
          <br>
          <label>Confirmer mot de passe</label>
          <input id="mdp" name="mdp" type="text" placeholder="" />
          <br>
     <input  type="submit" name="test" value="Valider">