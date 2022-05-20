<?php
namespace PostgreSQLTutorial;
/**
* Represent the Connection
* Yes
*/
    class Connection {
        /**
        * Connection
        * @var type
        */
        private static $conn;
        /**
        * Connect to the database and return an instance of \PDO object
        * @return \PDO
        * @throws \Exception
        */
        public function connect() {
        // read parameters in the ini configuration file
		$db = parse_url(getenv("DATABASE_URL"));

		$pdo = new \PDO("pgsql:" . sprintf(
			"host=%s;port=%s;user=%s;password=%s;dbname=%s",
			$db["host"],
			$db["port"],
			$db["user"],
			$db["pass"],
			ltrim($db["path"], "/")
		));
        return $pdo;
    }
    /**
    * return an instance of the Connection object
    * @return type
    */
    public static function get() 
    {
        if (null === static::$conn) 
        {
            static::$conn = new static();
        }
        return static::$conn;
    }
    protected function __construct() {

    }
    private function __clone() {

    }
    private function __wakeup() {

    }
}   