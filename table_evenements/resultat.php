<?php 
    include 'pdo.php'
?>
<html>
<header>
    <title>PDO</title>
    <link rel="StyleSheet" href="exo10.css">
</header>
<body>
<h1>PDO<h1>
<?php 
    $mon_pdo = new_pdo("mysql.etu.umontpellier.fr","e20160001532","e20160001532","1234");
    if($mon_pdo == null)
    {
        echo 'ERREUR! avec le PDO';
        echo '<br>';
    }
    else
    {   
        if(isset($_GET['option'])&&isset($_GET['ordre']))
        {
            $option = $_GET['option'];
            
            $option_str = '';
            
            $option_str = " opt = " . "'" . $option[0] . "'" . " ";

            for ($i=1; $i < count($option); $i++) 
            {
                $option_str = $option_str . " OR " . " opt = " . "'" . $option[$i] . "'" . " ";
            }

            //echo $option_str;

            $order = $_GET['ordre'];
            $sql = "SELECT * FROM ETUDIANT WHERE " . $option_str . " ORDER BY $order[0]";
            $resultat = $mon_pdo->query($sql);
            print_table("Etudiants",$resultat); 
        }
        else
        {
            echo 'Erreur, manque de attributs <br>';
        }
    }
?>
<script src="DOM_explorer.js"></script>
</body>
</html>