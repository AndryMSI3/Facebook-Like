<?php
    require 'vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;
    class SpecificException extends Exception{}
    // /* Execute this first before launching the main page */
    try 
    {
        $conn = Connection::get()->connect();
        $sql = 'CREATE TABLE IF NOT EXISTS users
        (
            id integer NOT NULL AUTO_INCREMENT,
            identifiant character varying(255) ,
            _password character varying(255),
            gender bit(1),
            birthdate date,
            lastname character varying(255),
            firstname character varying(255),
            confirmkey character varying(255),
            confirm boolean DEFAULT false,
            CONSTRAINT id PRIMARY KEY (id)
        )';
        $statement = $conn->prepare($sql);
        $statement->execute();
        echo "The database was created successfully!";
    } 
    catch (\PDOException $e) 
    {
    echo $e->getMessage();
    }
?>
