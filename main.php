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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    try{
                        $connection = mysqli_connect('localhost', 'root');
                        mysqli_select_db($connection,'projetoSI');
        
                        if(!$connection){   
                            echo("Connection failed: " . mysqli_connect_error());   
                            throw new Exception("");    
                        }   

                        $resultTableContents = mysqli_query($connection ,"select id, username, name, email, roleID from user ORDER BY ID");

                        if (!$resultTableContents) {
                            echo("<tr><td colspan='5'>Query failed.</td></tr>");
                            throw new ErrorException();
                        }
                        
                        $i = 0;

                        while ($row = mysqli_fetch_assoc($resultTableContents)){
                            $id = $row['id'] ?? '';
                            $username = $row['username'] ?? '';
                            $name = $row['name'] ?? '';
                            $email = $row['email'] ?? '';
                            $roleID = $row['roleID'] ?? '';
                            
                            echo "<tr> <form class=\"adminTableRowN$i\" action=\"updateUserRow.php\" method=\"post\">";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"ID\" value =\"$id\" id=\"tableInputID\" readonly></td>";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"username\" value =\"$username\" id=\"tableInput\"></td>";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"name\" value =\"$name\" id=\"tableInputName\"></td>";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"email\" value =\"$email\" id=\"tableInputEmail\"></td>";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"roleID\" value =\"$roleID\" id=\"tableInputRoleID\"></td>";
                            echo "<td> <input type=\"text\" class=\"tableInput\" name =\"password\" placeholder=\"Change Password\"></td>";
                            echo "<td><button type=\"submit\">Update Row</td>";
                            echo "<form> </tr>";
                            
                            $i +=1;
                        }
                    }
                    catch(Exception $e){
                    
                    }
        
                    
                    ?>
            </tbody>
        </table>

        
        
    </div>
    <script src="main.js"></script>
</body>
</html>
