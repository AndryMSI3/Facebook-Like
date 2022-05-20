<?php
    session_start();
    require '../vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;

    try{
        $message = "";
        $pdo = Connection::get()->connect();
        $sql = 'SELECT firstname,lastname,id FROM users WHERE identifiant = :identifiant AND _password = :_password ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':identifiant',$_POST['identifiant']);
        $stmt->bindValue(':_password',$_POST['password']);
        $stmt->execute();
        $message = $stmt->fetch();
        $re = '/^\+?(0|261)?(33|34|32)[0-9]{7}$/m';
        if((preg_match_all($re, $_POST['identifiant'], $matches, PREG_SET_ORDER, 0)))
        {
            if($message != "")
            {
                $stmt->bindValue(':identifiant',$_POST['identifiant']);
                $_SESSION["firstname"] = $message[0];
                $_SESSION["lastname"] = $message[1];
                $_SESSION["id"] = $message[2];
                header("Location:../facebook.php");
            }
            else if($message == "") 
            header("Location:../index.php?error2=*you are not registered yet or your password is wrong"); 
        }
        else if(filter_var($_POST['identifiant'], FILTER_VALIDATE_EMAIL))
        {
            if($message != "")
            {
                $stmt->bindValue(':identifiant',$_POST['identifiant']);
                $_SESSION["firstname"] = $message[0];
                $_SESSION["lastname"] = $message[1];
                $_SESSION["id"] = $message[2];
                header("Location:../facebook.php");

            }
            else if($message == "") 
            header("Location:../index.php?error2=*you are not registered yet or your password is wrong"); 
        }
        else
        {
            header("Location:../index.php?error2=*Please enter a valid ID");
        }
        if(empty($_POST['password']))
        {
            header("Location:../index.php?error2=*Please enter a password");
        }
    }
    catch(\PDOException $e)
    {
        throw $e;
    }