<?php
namespace PostgreSQLTutorial;
/**
* PostgreSQL PHP Update Demo
*/
class PostgreSQLShowRow {
    /**
    * PDO object
    * @var \PDO
    */
    private $pdo;
    /**
    * Initialize the object with a specified PDO object
    * @param \PDO $pdo
    */
    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }
    /**
    * Update stock based on the specified id
    * @param int $id
    * @param string $lastname
    * @param string $firstname
    * @return int
    */

    public function ShowRow()
    {
        $sql = 'SELECT id,identifiant,_password,gender,birthdate,lastname, firstname '
        .' FROM users '
        .' ORDER BY id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch()) {
            echo "id: " . $row["id"]." password: ".$row["_password"]." E-mail/Telephone: ".$row["identifiant"]
            ." gender: ".$row["gender"]." birthdate: ".$row["birthdate"]
            ." Name: " . $row["firstname"]
            . " " . $row["lastname"]. "<br>";
        }
    }
}