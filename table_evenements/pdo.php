<?php
function new_pdo($servername, $dbname, $username, $password)
{
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=3306;charset=UTF8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        echo '<br>';
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
        echo '<br>';
        return null;
    }

    return $conn;
}

function print_row($ligne, $size)
{
    echo '<tr>';
    for($c = 0; $c<$size; $c++) 
    {
        echo '<td>';
        echo $ligne[$c];    
        echo '</td>';   
    }
    echo '</tr>';
}

function print_col_names($ligne, $size)
{
    echo '<tr>';
    //c + 2 car ligne contient 2 keys
    for($c = 0; $c<$size; $c = $c+2) 
    {
        echo '<td>';
        echo $ligne[$c];    
        echo '</td>';   
    }
    echo '</tr>';
}

function print_table($nom, $table)
{
    $size_col = $table->columnCount();
    $premier_ligne = $table->fetch();
    echo '<br>';
    echo '<table>';
    echo '<thead>
            <tr>
                <th colspan="',$size_col,'">',$nom,'</th>
            </tr>
            ',
            /*table contient deux clef alors size_col * 2*/
            print_col_names(array_keys($premier_ligne),$size_col*2),'
         </thead>';
    
    echo '<tbody>';
    /*pour ne pas sauter la premier ligne*/
    print_row($premier_ligne,$size_col);
    //$table->execute();
    foreach ($table as $row) 
    {
        print_row($row, $size_col);    
    }
    echo '</tbody>'; 
    echo '</table>';
}

?>
