<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reqal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
    
        <dialog id="loginModal" class="modal">
            <button type="button" class="closeLoginModalButton" id="closeLoginModalButton"><img src="assets/svgs/x.svg"></button>
            <h2>Login</h2>
            <fieldset>
                <label for="username">Username or email<br></label>
                <input type="text" maxlength="254   " id="usernameOrEmail" name="usernameOrEmail" required><br>
                <label for="password">Password:<br></label>
                <input type="password" id="loginPassword" name="password" required><br>
                
                <div class="buttonSpacer">
                    <button type="submit">Log In</button>
                    <button type="button" class="altButton" id="createAccountButtonInsideLoginModal">Create a new account</button>
                </div>
            </fieldset>
        </dialog>

    
    <dialog id="accountCreationModal" class="modal">
        <button type="button" class="closeAccountCreationModalButton" id="closeAccountCreationModalButton"><img src="assets/svgs/x.svg"></button>
        <h2>Create Your Account</h2>
        <form name="createAccount" action="register.php" method="post">
            <fieldset>
                <label for="username">Username:<br></label>
                <input type="text" maxlength="254" id="username" name="username" required><br>
                <label for="name">Name:<br></label>
                <input type="text" maxlength="254" id="name" name="name" required><br>
                <label for="email">Email:<br></label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:<br></label>
                <input type="password" id="password" name="password" required><br>
                
                <div class="buttonSpacer">
                    <button type="submit">Create Account</button>
                    <button type="button" class="altButton" id="logInButtonInsideAccountCreationModal">Log In</button>
                </div>
            </fieldset>

            <div class="popUp" id="registerPopUp">
                <?php
                    try {
                        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
                            echo "<script>window.location.href = 'index.html';</script>";
                        }
        
                        $username = $_POST['username'] ?? '';
                        $name = $_POST['name'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $password = $_POST['password'] ?? '';
                        $connection = mysqli_connect('localhost', 'root');
                        mysqli_select_db($connection,'projetoSI');
        
                        if(!$connection){
                            echo("Connection failed: " . mysqli_connect_error());
                            throw new Exception("");
                        }
        
                        $queryCheckEmail = "select * from user where email = '$email'";
                        $queryCheckUsername  = "select * from user where username = '$username'";
                        $queryInsert = "insert into user(username, name, email, password, roleID) values ('$username', '$name', '$email', '$password', 3);";
                        $resultEmail = mysqli_query($connection, $queryCheckEmail); 
                        $resultUsername = mysqli_query($connection, $queryCheckUsername);
        
                        if (mysqli_num_rows($resultEmail) > 0){
                            echo("Email already exists");
                            throw new Exception("");
        
                        }elseif (mysqli_num_rows($resultUsername) > 0){
                            echo("Username already exists");
                            throw new Exception("");
                        }
        
                        if(mysqli_query($connection, $queryInsert)){
                            $_SESSION['username'] = $username;
                            $_SESSION['email'] = $email;
                            $_SESSION['roleID'] = 3;
                            echo "<script>window.location.href = 'main.html';</script>";
                        }
        
                        else{
                            echo("Error creating Account: ". mysqli_error($connection)."");}
                    }
                    catch(Exception $e){}
                ?>
            </div>
                    
        </form>
    </dialog>


</body>
<script src="index.js"></script>
<script src="registerPHP.js"></script>
</html>