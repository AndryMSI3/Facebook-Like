

<html>
    <head>
    <title>facebook</title>
    <link rel="stylesheet" type="text/css" href="/css/index.css">  
    <link rel="stylesheet" type="text/css" href="/css/modal.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <!-- Text on the left side -->

        <div id="account-side">
            <p id="facebook-title">facebook</p>
            <h2 id="little-text-1">With Facebook, share and stay in touch with those around you.</h2>
        </div>

         <!-- Inscription and connexion box on the right side -->

        <div id="login-side">     
            <div id="login-box">
                <br>
                <form action="/app/Connect-home.php" method="post">
                    <input name='identifiant'class="login-field" type="text" 
                    placeholder="Email or phone number">
                    <input name='password' class="login-field" type="password" placeholder="Password">
                    <div style="text-align:center;">
                <input type="submit" id="login-button" value="Login"></div>
                </form>
                <p id="error2" style="color:red" name="error2" value="<?php echo $_GET['error2'];?>">
                    <?php  
                        if(isset($_GET['error2']))
                        {
                            echo $_GET['error2'];
                        }    
                    ?>
                </p>
                <p id="error2" value="<!?php echo $_GET['message'];?>">
                    <?php  
                        if(isset($_GET['message'])) { echo $_GET['message']; }    
                    ?>
                </p>
                <p id="forgot-pswd">Forgot your password ?</p>
                <p id="line"></p>
                <button id="account-creation-button" >Create new account</button>
            </div>
            <p id="creation-page"><a id="create-page"><strong>Create a page</strong></a> 
            for a celebrity, a brand or a <br> business.
            </p>
        </div>

         <!-- Annex-side -->

        <div id="annex-side">
                <div id="language-side">
                    <p>Frantsay (France)</p> 
                    <p>Malagasy </p>
                    <p>English (US)</p>
                    <p>Italiano</p>
                    <p>Español</p>
                    <p>Deutsch</p>
                    <p>中文(简体)</p>
                    <p>Türkçe</p>
                    <p>Português (Brasil)</p> 
                    <p>العربیة </p>
                </div>
                <p id="line2"></p>
                <div id="subsdiary-side">
                <p>Register</p> <p>Login</p> <p>Messenger</p>
                    <p>Facebook Lite</p>
                    <p>Watch </p>
                    <p>Places</p>
                    <p>Games</p>
                    <p>Marketplace</p>
                    <p>Facebook Pay</p>
                    <p>Oculus</p>
                    <p>Portal</p>
                    <p>Instagram</p>
                    <p>Newsletter</p>
                    <p>Local</p>
                    <br>
                    <p>Fundraising</p>
                    <p>Services</p>
                    <p>Election Information Center</p>
                    <p>Groups</p>
                    <p>About</p>
                    <p>Create an ad </p>
                    <p>Create a Page</p>
                    <p>Developers</p>
                    <p>Jobs</p>
                    <br>
                    <p>Privacy</p>
                    <p>Cookies</p>
                    <p>Choose your ad </p>
                    <p>General conditions</p>
                    <p>Help</p>
                    <br><br>
                    <p>Meta © 2022</p>
                </div>    
        </div>
    
        <!-- Modal for account creation -->

        <div id="modal-account-creation" class="modal-account-creation">

            <!-- Modal content -->

            <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal-header">
                        <h1 id="suscride-title-1">Suscribe</h1>
                        <h2 id="suscribe-title-2">It's easy and fast</h2>
                        <p id="line3"></p>
                    </div>
                    <div class="modal-body">
                    <form action="app/Suscribe.php" method="post" >
                                <input class="form-field" id ="firstname-field" name="firstname" type="text" placeholder="Firstname">
                                <input class="form-field" id ="lastname-field" name ="lastname" type="text" placeholder="Lastname">
                                <input class="form-field" name="identifiant" type="text" placeholder="Phone number or e-mail" style="width: 100%;">
                                <input class="form-field" name ="password1" type="password" placeholder="Password" style="width: 100%;">
                                <input class="form-field" name ="password2" type="password" placeholder="Confirm password" 
                                style="width: 100%;">
                                <p id="little-text-3" style="margin:unset">Birthdate</p>
                            <div id="birthday-box">
                                <input class="birthday" id="birthday-day"  name="day"style="height:33px;" type="number" 
                                    min="1" max="31" onchange="change_birthday()">
                                <select class="birthday" name= "month" id="birthday-month" style="height:33px;margin-left: 3%;" 
                                onchange="change_birthday()">
                                    <option value="january">january</option>
                                    <option value="february">february</option>
                                    <option value="march">march</option>
                                    <option value="april">april</option>
                                    <option value="may">may</option>
                                    <option value="june">june</option>
                                    <option value="july">july</option>
                                    <option value="august">august</option>
                                    <option value="september">september</option>
                                    <option value="october">october</option>
                                    <option value="november">november</option>
                                    <option value="december">december</option>
                                </select>
                                <input id="birthday-year" name ="year" style="height:33px;margin-left: 3%;" class="birthday" 
                                type="number" min="1900" max="2004" onchange="change_birthday()">
                            </div>
                            <p id="little-text-3" style="margin:unset">Gender</p>
                            <div id="gender-box">
                                <p class="gender"> Female
                                    <input class="cercle_radio" type="radio" name="gender" value="female">
                                </p>
                                <p class="gender" style="margin-left: 10px;"> Male
                                    <input class="cercle_radio"  type="radio" name="gender" value="male">
                                </p>
                            </div>
                        </div>
                        <?php if(isset($_GET['error'])){ ?>
                        <p id="error" name="error" value="<?php echo $_GET['error'];?>" onchange="display_block();">
                            <?php echo $_GET['error'];?>
                        </p>
                        <?php } ?>   
                        <p id="little-text-4">By pressing Register, you agree to our <a href="">Terms & Conditions</a>,
                        our <br><a href="">Data Use Policy</a> and our <a href="">Use Policy
                        </a> cookies. You may receive text message notifications from us and you
                        can unsubscribe at any time.
                        </p>
                        <div style="text-align:center">
                            <button type="submit" id="suscribe-button">Suscribe</button>
                        </div>
                    </form>
            </div>
        </div> 
        <script src="/js/modal.js"></script>
    </body>
</html>
<?php
    require 'vendor/autoload.php';
    use PostgreSQLTutorial\Connection as Connection;
    class SpecificException extends Exception{}
    try 
    {
        Connection::get()->connect();
        echo 'A connection to the PostgreSQL database sever has been established successfully';
    } 
    catch (\PDOException $e) 
    {
    echo $e->getMessage();
    }
?>

