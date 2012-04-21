<?php
class pdocore
{
    public $dbh; // handle of the db connexion
    private static $instance;

    private function __construct()
    {
        // building data source name from config
        $dsn = 'mysql:host=' . DB_HOST .
               ';dbname='    . DB_NAME .
               ';port='      . DB_PORT.
               ';connect_timeout=15';
        // getting DB user from config
        $user = Config::read(DB_USER);
        // getting DB password from config
        $password = Config::read(DB_PASS);

        try
        {
        $this->dbh = new PDO($dsn, $user, $password);
        }
        catch(PDOException $e) {
        echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    // others global functions
}
?>

