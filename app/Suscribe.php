<?php
    session_start();
    require 'google-api-php-client/vendor/autoload.php';
    require '../vendor/autoload.php';
    require 'quickstart.php';
    use PostgreSQLTutorial\Connection as Connection;
    try 
    {
        $pdo = Connection::get()->connect();
        $sql = 'INSERT INTO users(identifiant,_password,gender,birthdate,firstname,lastname,confirmKey) 
        VALUES(:identifiant,:_password,:gender,:birthdate,:firstname,:lastname,:confirmKey)';
        $stmt = $pdo->prepare($sql);
        $month_in_number;
        switch (test_input($_POST['month']))
        {
            case "january":
                $month_in_number = 1;
                break;
            case "february":
                $month_in_number = 2;
                break;
            case "march":
                $month_in_number = 3;
                break;
            case "april":
                $month_in_number = 4;
                break;
            case "may":
                $month_in_number = 5;
                break;
            case "june":
                $month_in_number = 6;
                break;
            case "july":
                $month_in_number = 7;
                break;
            case "august":
                $month_in_number = 8;
                break;
            case "september":
                $month_in_number = 9;
                break;
            case "october":
                $month_in_number = 10;
                break;
            case "november":
                $month_in_number = 11;
                break;
            case "december":
                $month_in_number = 12;
                break;
        }
        if (empty(test_input($_POST["lastname"]))) 
        {
            $_SESSION['error'] = '*Name is required';
            header("Location:../index.php");
        } 
        else 
        {
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["lastname"]))) 
            {
                $_SESSION['error'] = '*Only empty letters and spaces are allowed';
                header("Location:../index.php");
            }
            else
            {
                $lastname =  test_input($_POST["lastname"]);
            }
          }
        if (empty(test_input($_POST["firstname"]))) 
        {
            $_SESSION['error'] = '*Firstname is required';
            header("Location:../index.php");
        } 
        else 
        {
        // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",test_input($_POST["firstname"])))
            {
                $_SESSION['error'] = '*Only empty letters and spaces are allowed';
                header("Location:../index.php");
            }
            else
            {
                $firstname =  test_input($_POST["firstname"]);
            }
        }
        if(empty(test_input($_POST['identifiant'])))
        {
            $_SESSION['error'] = '*And identifiant is required';
            header("Location:../index.php");
        }
        else
        {
            // $re = '/^\+?(0|261)?(33|34|32)[0-9]{7}$/m';
            // if((preg_match_all($re, $_POST['identifiant'], $matches, PREG_SET_ORDER, 0)))
            // {
            //     $stmt->bindValue(':identifiant',$_POST['identifiant']);
            // }
            $identifiant = test_input($_POST['identifiant']);
            if(filter_var($identifiant, FILTER_VALIDATE_EMAIL))
            {
                $sql_search_duplicate_mail = "SELECT * FROM users WHERE identifiant = '%$identifiant%'";
                $stmt2 = $pdo->prepare($sql_search_duplicate_mail);
                $stmt2->execute();
                $mailexist = $stmt2->rowCount();
                if($mailexist == 1)
                {
                    $_SESSION['error'] = '*This email was already used';
                    header("Location:../index.php");
                }
                else
                {
                    $stmt->bindValue(':identifiant',test_input($_POST['identifiant']));
                }
            }
            else
            {
                $_SESSION['error'] = '*Please enter a valid identifiant';
                header("Location:../index.php");
            }
        if (empty(test_input($_POST["gender"])))
        {
            $_SESSION['error'] = '*Gender is required';
            header("Location:../index.php");
        } 
        else 
        {
            $gender;
            if(test_input($_POST["gender"]) == "female")
            {
                $gender = 0;
            }
            else if(test_input($_POST["gender"]) == "male")
            {
                $gender = 1;
            }
        }
        if(empty( test_input($_POST["password1"])) || empty(test_input($_POST["password1"])))
        {
            $_SESSION['error'] = '*Password is required';
            header("Location:../index.php");
        }
        else
        {
            if(empty(test_input($_POST["password1"])) !== empty( test_input($_POST["password1"])))
            {
                $_SESSION['error'] = '*Passwords are not the same';
                header("Location:../index.php");
            }
            else
            {
                $_password =  test_input($_POST["password1"]);
            }
        }
        $correct_date =  test_input($_POST['year'])."-".$month_in_number."-". test_input($_POST['day']);
        if(empty( test_input($month_in_number)) ||empty( test_input( $_POST['year'])) || empty(test_input($_POST['day'])))
        {
            $_SESSION['error '] = '*Indicate a correct birthdate';
            header("Location:../index.php");
        }
        // pass values to the statement
        $confirmKey = random_str();
        $stmt->bindValue(':gender',$gender);
        $stmt->bindValue(':_password',$_password);
        $stmt->bindValue(':birthdate',$correct_date);
        $stmt->bindValue(':firstname',$firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':confirmKey', $confirmKey);
        $stmt->execute();
        $sql_last_id = "SELECT id FROM users WHERE id=(SELECT max(id) FROM users)";
        $stmt_max_id = $pdo->prepare($sql_last_id);
        $stmt_max_id->execute();     
        $id = $stmt_max_id->fetch();
        // execute the insert           
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Gmail($client);  
        echo $id[0];      
        $message_content ="
        <html>
            <body>
                <div align=3D\"center\">
                    <a href=3D\"https://limitless-temple-83849.herokuapp.com/app/confirmation.php?id=3D".
                    $id[0]."&key=3D".$confirmKey."\"> 
                        Please confirm your account
                    </a>  
                </div>
            </body>
        </html>
        ";
        echo $message_content."<br>";
        $message =  createMessage("facebooklike383@gmail.com",test_input($_POST['identifiant']),
         "test envoie de lien avec Gmail API",$message_content);
        sendMessage($service,"me", $message);
        echo "Account created successfully";
        }
    } 
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function random_str($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, ($charactersLength - 1))];
        }
        return $randomString;
    }
?>
