<?php
    require '../vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;
    use PostgreSQLTutorial\PostgreSQLShowRow as PostgreSQLShowRow;
    try 
    {
        $pdo = Connection::get()->connect();
        $showrow = new PostgreSQLShowRow($pdo);
        $sql_last_id = "SELECT id FROM users WHERE id=(SELECT max(id) FROM users)";
        $sql = 'INSERT INTO users(id,identifiant,_password,gender,birthdate,firstname,lastname) 
        VALUES(:id,:identifiant,:_password,:gender,:birthdate,:firstname,:lastname)';
        $stmt = $pdo->prepare($sql);
        $stmt_max_id = $pdo->prepare($sql_last_id);
        $stmt_max_id->execute();
        $id = $stmt_max_id->fetch();
        $id[0]++;
        $month_in_number;
        switch ($_POST['month'])
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
            case "juily":
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
        if (empty($_POST["lastname"])) 
        {
            header("Location:../index.php?error=*Name is required");
        } 
        else 
        {
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastname"])) 
            {
                header("Location:../index.php?error=*Only empty letters and spaces are allowed");
            }
            else
            {
                $lastname = $_POST["lastname"];
            }
          }
        if (empty($_POST["firstname"])) 
        {
            header("Location:../index.php?error=*Firstname is required");
        } 
        else 
        {
        // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstname"])) 
            {
                header("Location:../index.php?error=*Only empty letters and spaces are allowed");
            }
            else
            {
                $firstname = $_POST["firstname"];
            }
        }
        if(empty($_POST['identifiant']))
        {
            header("Location:../index.php?error=*And identifiant is required");
        }
        else
        {
            $re = '/^\+?(0|261)?(33|34|32)[0-9]{7}$/m';
            if((preg_match_all($re, $_POST['identifiant'], $matches, PREG_SET_ORDER, 0)))
            {
                $stmt->bindValue(':identifiant',$_POST['identifiant']);
            }
            else if(filter_var($_POST['identifiant'], FILTER_VALIDATE_EMAIL))
            {
                $stmt->bindValue(':identifiant',$_POST['identifiant']);
            }
            else
            {
                header("Location:../index.php?error=*Please enter a valid ID");
            }
        }
        if (empty($_POST["gender"])) 
        {
            header("Location:../index.php?error=*Gender is required");
        } 
        else 
        {
            $gender;
            if($_POST["gender"] == "female")
            {
                $gender = 0;
            }
            else if($_POST["gender"] == "male")
            {
                $gender = 1;
            }
        }
        if(empty($_POST["password1"]) || empty($_POST["password1"]))
        {
            header("Location:../index.php?error=*Password is required");
        }
        else
        {
            if(empty($_POST["password1"]) !== empty($_POST["password1"]))
            {
                header("Location:../index.php?error=*Passwords are not the same");
            }
            else
            {
                $_password = $_POST["password1"];
            }
        }
        $correct_date = $_POST['year']."-".$month_in_number."-".$_POST['day'];
        if(empty($month_in_number) ||empty( $_POST['year']) || empty($_POST['day']))
        {
            header("Location:../index.php?error=*Indicate a correct birthdate");
        }
        // pass values to the statement
        $stmt->bindValue(':id',$id[0]);
        $stmt->bindValue(':gender',$gender);
        $stmt->bindValue(':_password',$_password);
        $stmt->bindValue(':birthdate',$correct_date);
        $stmt->bindValue(':firstname',$firstname);
        $stmt->bindValue(':lastname', $lastname);
        // execute the insert statement
        $stmt->execute();
        echo "Account created successfully";
        $showrow->ShowRow();
    } 
    catch (\PDOException $e) 
    {
        if($e->getCode() == 23505)
        {
            header("Location:../index.php?error=*you have already registered");
        }
        else
        {
            echo $e->getMessage();
        }
    }
?>
