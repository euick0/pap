<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reqal</title>
    <link rel="stylesheet" href="styles.css">
    <body>
</head>
    <header>
        <div class="backgroundVideoContainer">
            <video id="backgroundVideo" autoplay muted loop playsinline>
                <source src="assets/videos/Video%20Reqal%20Background.mp4" type="video/mp4">
            </video>
        </div>

        <div class ="logoWithText">
            <img src="assets/svgs/Reqal%20Logo%20W-text%20-%20Dark%20Mode.svg" alt="Reqal Logo" class="logo">
        </div>

        <nav class="navLinks">
            <a href="#features" class="link">Features</a>
            <a href="#pricing" class="link">Pricing</a>
            <button class="openLoginModalButton buttonOnlyText link">Login</button>
            <button class="altLink openAccountCreationModalButton">Create Account</button>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1 class="heroTitle">Learn any language</h1>
            <h1 class="heroTitle" id="secondaryHeroTitle">Travel wherever you want</h1>
            <h2 class="heroSubtitle">Start your language learning journey today.</h2>
            <button class="heroButton altLink openAccountCreationModalButton ">Get Started</button>
        </section>
    </main>

    
    <dialog id="accountCreationModal" class="modal">
        <button type="button" class="closeAccountCreationModalButton" id="closeAccountCreationModalButton"><img src="assets/svgs/x.svg"></button>
        <h2>Create Your Account</h2>
        <form name="createAccount" action="register.php" method="POST">
            <fieldset>
                <label for="username">Username:<br></label>
                <input type="text" id="username" name="username" required><br>
                <label for="name">Name:<br></label>
                <input type="text" id="name" name="name" required><br>
                <label for="email">Email:<br></label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:<br></label>
                <input type="password" id="password" name="password" required><br>
                
                <div class="buttonSpacer">
                    <button type="submit">Create Account</button>
                    <button type="button" class="altButton" id="logInButtonInsideAccountCreationModal">Log In</button>
                </div>
            </fieldset>
        </form>
    </dialog>

    <dialog id="loginModal" class="modal">
        <h2>Login</h2>
        <button type="button" class="closeLoginModalButton" id="closeLoginModalButton"><img src="assets/svgs/x.svg"></button>
        <form name="login" action="login.php" method="POST">
            <fieldset>
                <label for="username">Username or email<br></label>
                <input type="text" id="usernameOrEmail" name="usernameOrEmail" required><br>
                <label for="password">Password:<br></label>
                <input type="password" id="loginPassword" name="password" required><br>
                
                <div class="buttonSpacer">
                    <button type="submit">Log In</button>
                    <button type="button" class="altButton" id="createAccountButtonInsideLoginModal">Create a new account</button>
                </div>
            </fieldset>
            <div class="popUp" id="loginPopUp">
                <?php
                    try{
                        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
                            echo "<script>window.location.href = 'index.html';</script>";
                        }
                        $usernameOrEmail = $_POST["usernameOrEmail"] ?? '';
                        $password = $_POST["password"] ?? '';
                        $connection = mysqli_connect('localhost', 'root');
                        mysqli_select_db($connection,'projetoSI');

                        
                        if(!$connection){
                            echo("Connection failed: " . mysqli_connect_error());
                            throw new Exception("");    
                        }

                        $querySearchEmail = "select * from user where email = '$usernameOrEmail'";
                        $querySearchUsername = "select * from user where username = '$usernameOrEmail'";
                        $resultEmail = mysqli_query($connection, $querySearchEmail);
                        $resultUsername = mysqli_query($connection, $querySearchUsername);
                        
                        if( mysqli_num_rows($resultEmail) or mysqli_num_rows($resultEmail) > 0){
                            $resultPassword = mysqli_query($connection,    "select password from user where email = '$usernameOrEmail'") ?? '';
                            $_SESSION['email'] = $usernameOrEmail;
                            $resultUsername = mysqli_query($connection,"select username from user where email = '$usernameOrEmail' ") ?? '';
                        }
                        elseif( mysqli_num_rows($resultUsername) > 0){
                            $resultPassword = mysqli_query($connection,    "select password from user where username = '$usernameOrEmail'") ?? '';
                        }
                        else{
                            echo("Username or email not found");
                            throw new Exception("");
                        }
                        
                        $username = mysqli_fetch_assoc($resultUsername)['username'];
                        $resultRoleID = mysqli_query($connection, "select roleID from user where username = '$username'");
                        $storedPassword = mysqli_fetch_assoc($resultPassword)['password'] ?? '';
                        
                        $isPasswordCorrect = false;
                        if (password_verify($password, $storedPassword) or((string)$password == (string)$storedPassword)) $isPasswordCorrect = true;

                        if(( mysqli_num_rows($resultUsername) > 0 or mysqli_num_rows($resultEmail) > 0) and $isPasswordCorrect){
                            $_SESSION['username'] = $username;
                            $_SESSION['roleID'] = (int)mysqli_fetch_assoc($resultRoleID)['roleID'];
                            echo "<script>window.location.href = 'main.php';</script>";
                        }
                        else{
                            echo("Password Incorrect");
                            throw new Exception("");
                        }
                    }
                    
                    catch(Exception $e){
                    }                
                ?>
                
            </div>
        </form>
    </dialog>
    
    
    <script src="index.js"></script>
    <script src="loginPHP.js"></script>
</body>
</html>