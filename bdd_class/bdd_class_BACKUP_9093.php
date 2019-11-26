 <?php
    class DataBase
    {
        private $db_pdo;
<<<<<<< HEAD
        private $username   = "omvadmin";
        private $dbname     = "HLIN511";
        private $servername = "localhost";
        private $password   = "openmediavault";
=======
        private const username   = "root";
        private const dbname     = "hlin511";
        private const servername = "localhost";
        private const password   = "";
>>>>>>> 544301e1e813c892504af3759d1c35e5385fc644
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
