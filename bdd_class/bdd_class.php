  <?php
    class DataBase
    {
        private $db_pdo;
        
        function __construct($servername, $dbname, $username, $password)
        {
            try
            {
                $this->db_pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $this->db_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }        
        }

        function getPDO(){return $this->db_pdo;}
    }
?>