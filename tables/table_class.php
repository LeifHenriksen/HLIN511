<?php
class Table
{
    
    public static function printTable($nomtable, $resultat_requete)
    {
        $size_col = $resultat_requete->columnCount();
        $premier_ligne = $resultat_requete->fetch();
        echo '<br>';
        echo '<table>';
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
        echo '<br>';
        echo '<form action="" method="get">';
        echo '<table>';
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

                foreach ($resultat_requete as $row) 
                {
                    (new self)->print_row_button($row, $size_col, $nombutton);    
                }
                echo '</tbody>'; 
                echo '</table>';
                echo '</form>';
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
        echo '<button name="'.$nombutton.'" type="submit" value="'.$ligne[0].'">'.$nombutton.'</button>';
        echo '</td>'; 
        echo '</tr>';
    }

    private function print_col_names($ligne, $size, $button)
    {
        echo '<tr>';
        //i + 2 car une ligne contient 2 keys
        for($i = 0; $i<$size; $i = $i+2) 
        {
            echo '<td>';
            echo $ligne[$i];    
            echo '</td>';   
        }
        if($button)
        {
            echo '<td>';
            echo 'Action';    
            echo '</td>';   
        }
        echo '</tr>';
    }
}
?>
