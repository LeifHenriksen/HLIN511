<!DOCTYPE html>
<html >
<head>
<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="style2.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <style>
      th {
          cursor: pointer;
      }
      </style>
<style>
.checked {
          cursor: pointer;
          color: orange;
 }
      .fa-star {
          cursor: pointer;
       }
      </style>
</head>
<body class="bg">
<?php
session_start();
include '../bdd_class/bdd_class.php';
include '../tables/table_class.php';
include '../user_class/user_class.php';



    $bdd = new DataBase();
   
    //$ActualUser->printNavBar($user_type);
    User::printNavGuest();

    echo '<header>';
   // echo '<title>'.$_GET["nom_table"].'</title>';
    echo '<link rel="StyleSheet" href="../login/style2.css">';
    echo '</header>';
    echo '<body>';
    // echo '<h1 class="display-1">'.$_GET["nom_table"].'</h1>';
    echo '<div class=container>';

    $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF, DATE_EV FROM EVENEMENT WHERE DATE_EV >= CURRENT_DATE()";
    $resultat = $bdd->getPDO()->query($sql);
    Table::printTable("Evénements",$resultat);

    $sql = "SELECT ID_EVENT, NOM_EVENT, ADRESSE, THEME, DESCRIPTIF, DATE_EV FROM EVENEMENT WHERE DATE_EV < CURRENT_DATE()";
    $resultat = $bdd->getPDO()->query($sql);
    Table::printTable("Ancien événements",$resultat);
    //Table::printTableButton("EVENEMENTS","Inscription",$resultat);
    

?>
<script src="scripts/trier_table.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>
    
