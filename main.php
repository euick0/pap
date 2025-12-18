<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="main.css">
    <title>Main</title>
</head>
<body>
    <aside class="mainAside">
        <div class="topIcons">
            <div class ="iconContainer" id="logoIconContainer">
                <img src="assets/svgs/Reqal Logo - Dark Mode.svg">
            </div>
            <?php
        
            $username = $_SESSION['username'] ?? 'Guest';
            $roleID = $_SESSION['roleID'] ?? 1;
    
            if($roleID == 1) {
                echo('<div class ="iconContainer" id="adminIconContainer">
                <img src="assets/svgs/protect.svg">
                </div>');
            }
            
            ?>
            
        </div>
            
        <div class="bottomIcons">            
            <div class ="iconContainer" id="accountOptionsIconContainer">
                <img src="assets/svgs/menu.svg">
            </div>
        </div>
    </aside>


    <div class="content" id="mainContent">
        <?php
        echo("<h1>Hi, $username, ready to start language learning?<h1>")
        ?>
        
    </div> 
    
    <div class="content inactive" id="adminContent">
        <h1>Admin Panel</h1>

    </div>
    <script src="main.js"></script>
</body>
</html>
