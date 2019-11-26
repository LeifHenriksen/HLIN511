 <?php
    class DataBase
    {
        private $db_pdo;
        private const username   = "root";
        private const dbname     = "hlin511";
        private const servername = "localhost";
        private const password   = "";
        function __construct()
        {
            try
            {
                $this->db_pdo = new PDO("mysql:host=".self::servername.";dbname=".self::dbname,
                                         self::username, self::password);
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