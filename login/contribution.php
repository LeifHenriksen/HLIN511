<form action="validation_contribution.php" method="post">
         <label for="nom">Nom de l'évenement</label>
         <input id="nom" name="nom" type="text" /><br />
         <label for="prenom">Adresse </label>
         <input id="prenom" name="adresse" type="text" /><br />
         <label for="latitude">Latitude </label>
         <input id="latitude" name="Latitude" type="text" placeholder="3.46" />
         <label for="latitude">Longitude </label>
         <input id="latitude" name="Latitude" type="text" placeholder="43.65" />
          <label>Theme</label>
          <input id="theme" name="theme" type="text" placeholder="jerems34" />
          <br>
          <label>Date de l'évenement</label>
          <input id="mdp" name="mdp" type="text" placeholder="mm/dd/yyyy" />
          <br>
          <label>Descriptif de l'évenement</label>
          <input id="desc" name="desc" type="text" placeholder="Randonée en groupe de 12 personnes autour du pic saint loup ...." />
          <label>Effectif maximum</label>
          <input id="eff" name="eff" type="int" placeholder="50" />
          <br>
     <input  type="submit" name="test" value="Ajouter l'évenement">