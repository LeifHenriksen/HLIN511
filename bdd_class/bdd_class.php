 <?php
    class DataBase
    {
        private $db_pdo;
        private $username   = "omvadmin";
        private $dbname     = "HLIN511";
        private $servername = "localhost";
        private $password   = "openmediavault";
        function __construct()
        {
            try
            {
                $this->db_pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
                                                      $this->username, $this->password);
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
