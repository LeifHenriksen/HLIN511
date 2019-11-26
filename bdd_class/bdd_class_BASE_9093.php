 <?php
    class DataBase
    {
        private $db_pdo;
        private const username   = "e20160001532";
        private const dbname     = "e20160001532";
        private const servername = "mysql.etu.umontpellier.fr";
        private const password   = "1234";
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