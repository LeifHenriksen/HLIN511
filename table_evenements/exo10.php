<html>
<header>
    <title>PDO</title>
    <link rel="StyleSheet" href="exo10.css">
</header>
<body>
    <h1>PDO<h1>
    <h2>Options</h2>    
        
    <form action="resultat.php">
        <input type="checkbox" name="option[]" value="B"> Bio-info
        <br>
        <input type="checkbox" name="option[]" value="C">Chimie
        <br>
        <input type="checkbox" name="option[]" value="L">Langue naturelle
        <br>
        <input type="checkbox" name="option[]" value="S">Syst. d' Info. Géo.
        <br>
        <input type="checkbox" name="option[]" value="W">Web
        <br>

        <h2>Ordre d'affichage</h2> 
    
        <input type="radio" name="ordre[]" value="nom"> nom<br>
        <input type="radio" name="ordre[]" value="prenom"> prenom<br>
        <input type="radio" name="ordre[]" value="statut"> statut<br>
        <input type="radio" name="ordre[]" value="groupe"> groupe<br>
        <input type="radio" name="ordre[]" value="opt"> option<br><br>
      
        <input type="submit">
        <input type="reset"> 
    </form> 
</body>
</html>