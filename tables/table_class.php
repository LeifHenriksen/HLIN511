<?php
class Table
{
    
    public static function printTable($nomtable, $resultat_requete)
    {
        $size_col = $resultat_requete->columnCount();
        $premier_ligne = $resultat_requete->fetch();
        if($premier_ligne == false)
        {
            echo 'Resultat vide.';
            return;
        }
        
        echo '<table style="padding-top:10vh" id = "table_generique">';
        echo '<thead>
                <tr>
                   <th colspan="',$size_col,'">',$nomtable,'</th>
                </tr>
             ',
                //table contient deux clef alors size_col * 2
               (new self)->print_col_names(array_keys($premier_ligne),$size_col*2, false),'
             </thead>';
                
                echo '<tbody>';

                //pour ne pas sauter la premier ligne
                (new self)->print_row($premier_ligne, $size_col);

                foreach ($resultat_requete as $row) 
                {
                    (new self)->print_row($row, $size_col);    
                }
                echo '</tbody>'; 
                echo '</table>';
    }

    private function print_row($ligne, $size)
    {
        echo '<tr>';
        for($i = 0; $i<$size; $i++) 
        {
            echo '<td>';
            echo $ligne[$i];    
            echo '</td>';   
        }
        echo '</tr>';
    }
    //Cree une table avec un des buttons, le button envoi la valeur 0 de son colonne(ID normalement)
    //via GET
    public static function printTableButton($nomtable, $nombutton, $resultat_requete)
    {
        $size_col = $resultat_requete->columnCount();
        $premier_ligne = $resultat_requete->fetch();
        if($premier_ligne == false)
        {
            echo 'Resultat vide.';
            return;
        }
       
        echo '<form action="" method="get">';
	echo '<table class="table table-hover" id = "table_generique">';
        echo '<thead>
                <tr>
                   <th colspan="',$size_col+1,'">',$nomtable,'</th>
                </tr>
             ',
                //table contient deux clef alors size_col * 2
                (new self)->print_col_names(array_keys($premier_ligne),$size_col*2, true),'
             </thead>';
                
                echo '<tbody>';

                //pour ne pas sauter la premier ligne
                (new self)->print_row_button($premier_ligne, $size_col, $nombutton);
                (new self)->print_row_rating($premier_ligne, $size_col);
                foreach ($resultat_requete as $row) 
                {
                    (new self)->print_row_button($row, $size_col, $nombutton);    
                    (new self)->print_row_rating($row, $size_col);
                }
                echo '</tbody>'; 
                echo '</table>';
		echo "<input type='hidden' name='nom_table' value=$nomtable>";
                echo '</form>';
    }
   private function print_row_rating($ligne,$size){
       echo '<tr>';

        
        
       echo '<head> <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"></head>
       
       <tr>
                    <span id="rateMe2" class="empty-stars"</span></tr>
                     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                   <script src="rating.js"></script>
                        ';
        echo '</tr>'; 
        echo '</tr>';
    }
   
    private function print_row_button($ligne, $size, $nombutton)
    {
        echo '<tr>';
        for($i = 0; $i<$size; $i++) 
        {
            echo '<td>';
            echo $ligne[$i];    
            echo '</td>';   
        }
        echo '<td>';
        echo '<button class="btn btn-success"style="width:100%"" name="'.$nombutton.'" type="submit" value="'.$ligne[0].'">'.$nombutton.'</button>';
        echo '</td>'; 
        echo '</tr>';
    }

    private function print_col_names($ligne, $size, $button)
    {
        echo '<tr>';
        //i + 2 car une ligne contient 2 keys
        for($i = 0; $i<$size; $i = $i+2) 
        {
            echo '<th onclick=sortTable('.$i/2 .')>';
            echo $ligne[$i];    
            echo '</th>';   
        }
        if($button)
        {
            echo '<th>';
            echo 'Action';    
            echo '</th>';   
        }
        echo '</tr>';
    }
}
?>
