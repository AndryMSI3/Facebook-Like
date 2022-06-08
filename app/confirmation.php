<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    require '../vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;
    if(isset($_GET['id'],$_GET['key']) AND !empty($_GET['id']) AND !empty($_GET['key']))
    {
        $pdo = Connection::get()->connect();
        $id = htmlspecialchars($_GET['id']);
        $key = htmlspecialchars($_GET['key']);
        echo $id;
        $requser =  $pdo->prepare("SELECT * FROM users WHERE id = $id AND confirmKey LIKE '%$key%'");
        $requser->execute();
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $user = $requser->fetch();
            if($user['confirm'] == 0)
            {
                $update_user = $pdo->prepare("UPDATE users SET confirm = TRUE WHERE id = $id AND confirmKey LIKE '%$key%'"); 
                $update_user->execute();
                echo "Your account was successfully confirmed!";
            }
            else
            {
                echo "Your account was already confirmed!";
            }
        }
        else
        {
            echo "The user dont exist!";
        }


    }
?>
    <h1>YES! YOU DID IT</h1>
</body>
</html>