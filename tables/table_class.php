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
        
        echo '<table class="table table-hover" id = table_generique>';
        echo '<thead>
                <tr>
                   <th colspan="',$size_col,'">',$nomtable,'</th>
                </tr>
             ',
                //table contient deux clef alors size_col * 2
                                      (new self)->print_col_names(array_keys($premier_ligne),$size_col*2, false, false),'
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
                                      (new self)->print_col_names(array_keys($premier_ligne),$size_col*2, true, false),'
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
                echo "<input type='hidden' name='nom_table' value=$nomtable>";
                echo '</form>';
    }

    public static function printTableButtonEtEtoiles($nomtable, $nombutton, $resultat_requete, $bdd, $avg)
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
                   <th colspan="',$size_col+2,'">',$nomtable,'</th>
                </tr>
             ',
                //table contient deux clef alors size_col * 2
                                      (new self)->print_col_names(array_keys($premier_ligne),$size_col*2, true, true),'
             </thead>';
                
                echo '<tbody>';

                //pour ne pas sauter la premier ligne
                (new self)->print_row_button_etoiles($premier_ligne, $size_col, $nombutton, $bdd, $avg);
                foreach ($resultat_requete as $row) 
                {
                    (new self)->print_row_button_etoiles($row, $size_col, $nombutton, $bdd, $avg);    
                }
                echo '</tbody>'; 
                echo '</table>';
                echo "<input type='hidden' name='nom_table' value=$nomtable>";
                echo '</form>';
    }
    private function print_etoiles($id_evenement, $note, $avg){
        echo '<td>';
        if(!$avg)
        {
            if($note == NULL)
            {
                for($i = 1; $i<6; $i++)
                {
                    echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star"  onClick="click_etoile(this.id)"></span>';
                }
            }
            else
            {
                for($i = 1; $i<6; $i++)
                {
                    if((int)$note > 0)
                    {
                        echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star checked"  onClick="click_etoile(this.id)"></span>';
                        $note--;
                    }
                    else
                    {
                        echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star"  onClick="click_etoile(this.id)"></span>';
                    }
                }
            }
        }
        else
        {
            if($note == NULL)
            {
                for($i = 1; $i<6; $i++)
                {
                    echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star"></span>';
                }
            }
            else
            {
                for($i = 1; $i<6; $i++)
                {
                    if((int)$note > 0)
                    {
                        echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star checked"></span>';
                        $note--;
                    }
                    else
                    {
                        echo '<span id="etoile_'.$i.'_ev_'.$id_evenement.'"class="fa fa-star"></span>';
                    }
                }
            }
        }
        echo '</td>';
    }
    
    
    private function print_row_button_etoiles($ligne, $size, $nombutton, $bdd, $avg)
    {
        if($avg)
        {
            $sql = 'SELECT AVG(NOTE) FROM RATING WHERE ID_EV = '.$ligne[0];
            $resultat = $bdd->getPDO()->query($sql);
            $note = $resultat->fetch();
        }
        else
        {
            $sql = 'SELECT NOTE FROM RATING WHERE ID_EV = '.$ligne[0].' AND ID_UTILISATEUR = '.$_SESSION['user_id'];
            $resultat = $bdd->getPDO()->query($sql);
            $note = $resultat->fetch();
        }
        echo '<tr>';
        for($i = 0; $i<$size; $i++) 
        {
            echo '<td>';
            echo $ligne[$i];    
            echo '</td>';   
        }
        (new self)->print_etoiles($ligne[0], $note[0], $avg);
        echo '<td>';
        //$ligne[0]==id
        echo '<button class="btn btn-success"style="width:100%"" name="'.$nombutton.'" type="submit" value="'.$ligne[0].'">'.$nombutton.'</button>';
        echo '</td>'; 
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

    private function print_col_names($ligne, $size, $button, $etoiles)
    {
        echo '<tr>';
        //i + 2 car une ligne contient 2 keys
        for($i = 0; $i<$size; $i = $i+2) 
        {
            echo '<th onclick=sortTable('.$i/2 .')>';
            echo $ligne[$i];    
            echo '</th>';   
        }
        
        if($etoiles)
        {
            echo '<th>';
            echo 'Rating';    
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
