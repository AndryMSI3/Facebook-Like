<?php
    session_start();
    require '../vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;

    try{
        $message = "";
        $pdo = Connection::get()->connect();
        $sql = 'SELECT firstname,lastname,id FROM users WHERE identifiant = :identifiant AND _password = :_password ';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':identifiant',test_input($_POST['identifiant']));
        $stmt->bindValue(':_password',test_input($_POST['password']));
        $stmt->execute();
        $message = $stmt->fetch();
        // $re = '/^\+?(0|261)?(33|34|32)[0-9]{7}$/m';
        // if((preg_match_all($re, $_POST['identifiant'], $matches, PREG_SET_ORDER, 0)))
        // {
        //     if($message != "")
        //     {
        //         $stmt->bindValue(':identifiant',$_POST['identifiant']);
        //         $_SESSION["firstname"] = $message[0];
        //         $_SESSION["lastname"] = $message[1];
        //         $_SESSION["id"] = $message[2];
        //         header("Location:../facebook.php");
        //     }
        //     else if($message == "") 
        //     header("Location:../index.php?error2=*you are not registered yet or your password is wrong"); 
        // }
        if(filter_var(test_input($_POST['identifiant']), FILTER_VALIDATE_EMAIL))
        {
            if($message != "")
            {
                $stmt->bindValue(':identifiant',test_input($_POST['identifiant']));
                $_SESSION["firstname"] = $message[0];
                $_SESSION["lastname"] = $message[1];
                $_SESSION["id"] = $message[2];
                header("Location:../facebook.php");

            }
            else if($message == "") 
            {
                $_SESSION['error2'] = "*you are not registered yet or your password is wrong";
                header("Location:../index.php"); 
            }
        }
        else
        {
            $_SESSION['error2'] = "*Please enter a valid Identifiant";
            header("Location:../index.php");           
        }
        if(empty($_POST['password']))
        {
            $_SESSION['error2'] = "*Please enter a password";
            header("Location:../index.php"); 
        }
    }
    catch(\PDOException $e)
    {
        throw $e;
    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }