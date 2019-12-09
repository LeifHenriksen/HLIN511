<?php
session_start();
include '../bdd_class/bdd_class.php';
if(isset($_SESSION['username'])) 
{	
    $a=[];
    $bdd = new DataBase();

    // get the q parameter from URL
    $q         = $_REQUEST["q"];
    $nom_table = $_REQUEST["table"];
    $attribut  = $_REQUEST["attribut"];
    $sql       = "SELECT ".$attribut." FROM ".$nom_table;
    $resultat  = $bdd->getPDO()->query($sql);
    
    foreach($resultat as $theme)
    {
        $a[] = $theme[$attribut];
    }

    $hint = "";

    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($a as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= ", $name";
                }
            }
        }
    }

    // Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "no suggestion" : $hint;
}
?> 
