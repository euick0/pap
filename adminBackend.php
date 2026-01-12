<?php session_start(); ?>

<?php

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            echo "<script>window.location.href = 'index.html';</script>";
        }
        
        $id = $_POST['id'] ?? '';
        $username = $_POST['username'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $roleID = $_POST['roleID'] ?? '';
        $search = $_POST['search'] ?? '';
        $action = $_POST['action'] ?? '';

        $currentEmail = $_SESSION['email'] ?? '';
        $currentUsername = $_SESSION['username'] ?? '';
        
        if ($action === "logOut"){
            session_unset();
            session_destroy();
            echo "<script>window.location.href = 'index.html';</script>";
        }

        $queryCheckUsername  = "select * from user where username = '$username' and id = $id;";
        $queryCheckEmail = "select * from user where email = '$email' and id = $id;";
        $queryCheckRoleID = "select * from user where RoleID = '$id' and id = $id;";
        $queryCheckName = "select * from user where name= '$name' and id = $id;";
        $queryCheckCurrentUserID = "select id from user where email = '$currentEmail' or username = '$currentUsername';";
        
        $connection = mysqli_connect('localhost', 'root');
        mysqli_select_db($connection,'projetoSI');

        if(!$connection){
            $_SESSION['adminMessage'] =  "Error: " . mysqli_connect_error() . "";
            $_SESSION['adminMessageType'] = "ERROR";  
            echo "<script>window.location.href = 'main.php?page=admin';</script>";
        }

        $queryUpdateUsername = "update user set username = '$username' where id = $id;";
        $queryUpdateEmail = "update user set Email = '$email' where id = $id;";
        $queryUpdateName = "update user set Name = '$name' where id = $id;";
        $queryUpdatePassword = "update user set Password = '$hashedPassword' where id = $id;";
        $queryUpdateRoleID = "update user set RoleID = '$roleID' where id = $id;";
        $queryDeleteUser = "delete from user where id = $id;";

        if($action === "add"){
            $querySelectLastID = "SELECT MAX(id) AS max_id FROM user;";
            $resultSelectLastID = mysqli_query($connection, $querySelectLastID);
            
            if (!$resultSelectLastID) {
                $_SESSION['adminMessage'] = "Error: " . mysqli_error($connection);
                $_SESSION['adminMessageType'] = "errorPopUp";
                echo "<script>window.location.href = 'main.php?page=admin';</script>";
                throw new Exception("");

            }

            $row = mysqli_fetch_assoc($resultSelectLastID);
            $nextID = ((int)($row['max_id'] ?? 0)) + 1;

            $queryAddUser = "insert into user (username, name, email, password, roleID) values ('newUserName$nextID', 'newUser$nextID', 'newUser$nextID@email.com', SHA2('newUserPassword$nextID', 256), '3')";
            $resultAddUser = mysqli_query($connection, $queryAddUser);

            if ($resultAddUser) {
                $_SESSION['adminMessage'] = "New user added successfully";
                $_SESSION['adminMessageType'] = "successPopUp";

            } else {
                $_SESSION['adminMessage'] = "Error: " . mysqli_error($connection);
                $_SESSION['adminMessageType'] = "errorPopUp";
            }

            unset($_SESSION['globalSearchIds']);
            unset($_SESSION['searchQuery']);
            echo "<script>window.location.href = 'main.php?page=admin';</script>";
            throw new Exception("");
        }

        
        if($action === "search"){
            if($search == ""){
                unset($_SESSION['globalSearchIds']);
                $_SESSION['adminMessageType'] = "successPopUp";
                echo "<script>window.location.href = 'main.php?page=admin';</script>";
            }
            $queryGlobalSearch = "select id from user where id like '%$search%' or username like '%$search%' or name like '%$search%' or email like '%$search%' or roleID like '%$search%';";
            $resultGlobalSearch = mysqli_query($connection, $queryGlobalSearch);

            if(!$resultGlobalSearch){
                $_SESSION['adminMessage'] = "Error: " . mysqli_error($connection);
                $_SESSION['adminMessageType'] = "errorPopUp";
                echo "<script>window.location.href = 'main.php?page=admin';</script>";
                throw new Exception("");
            }
            
            $ids = [];
            while ($row = mysqli_fetch_assoc($resultGlobalSearch)) {
                $ids[] = (int)$row['id'];}

            $_SESSION['globalSearchIds'] = $ids; 
            $_SESSION['searchQuery'] = $search;
            $_SESSION['adminMessage'] = "Search found ".count($ids)." results";
            $_SESSION['adminMessageType'] = "successPopUp";
            echo "<script>window.location.href = 'main.php?page=admin';</script>";
        }

        $resultCheckEmail = mysqli_query($connection, $queryCheckEmail); 
        $resultCheckUsername = mysqli_query($connection, $queryCheckUsername);
        $resultCheckRoleID = mysqli_query($connection, $queryCheckRoleID);
        $resultCheckName = mysqli_query($connection, $queryCheckName);
        $resultCheckCurrentUserID = mysqli_query($connection, $queryCheckCurrentUserID);

        if($resultCheckCurrentUserID){
            $rowCheckCurrentUserID = mysqli_fetch_assoc($resultCheckCurrentUserID);
            $currentID = $rowCheckCurrentUserID ? (int)$rowCheckCurrentUserID['id'] : null;
        }
        
        if ($action === "delete"){
            
            if($currentID == $id){
                $resultDeleteUser = mysqli_query($connection, $queryDeleteUser);
                unset($_SESSION["username"]);
                unset($_SESSION["email"]);
                unset($_SESSION["roleID"]);
                echo "<script>window.location.href = 'index.html';</script>";
            }
            $resultDeleteUser = mysqli_query($connection, $queryDeleteUser);
            $_SESSION['adminMessage'] = "User $name deleted successfully";
            $_SESSION['adminMessageType'] = "successPopUp";

            if (!$resultDeleteUser){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            } 


            echo "<script>window.location.href = 'main.php?page=admin';</script>";
            throw new Exception("");
        }
        

        #se as queries de verificar nao retornarem nada, quer dizer que o admin mudou
        #o seu conteudo, logo temos que altera-las
        if(mysqli_num_rows($resultCheckUsername) == 0 ){
            $resultUpdateUsername = mysqli_query($connection, $queryUpdateUsername);
            if (!$resultUpdateUsername ){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            }
            if($currentID === $id){
                $_SESSION["username"] = $username;
            }
        }
        
        
        if(mysqli_num_rows($resultCheckName) == 0 ){
            $resultUpdateName = mysqli_query($connection, $queryUpdateName);
            if (!$resultUpdateName){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            }
        }
        
        
        if(mysqli_num_rows($resultCheckEmail) == 0 ){
            $resultUpdateEmail = mysqli_query($connection, $queryUpdateEmail);
            if (!$resultUpdateEmail){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            }
            if($currentID === $id){
                $_SESSION["email"] = $email;
            }
        }
        
        
        if(mysqli_num_rows($resultCheckRoleID) == 0 ){
            $resultUpdateRoleID = mysqli_query($connection, $queryUpdateRoleID);
            if (!$resultUpdateRoleID){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            }
            if($currentID === $id){
                $_SESSION["roleID"] = $roleID;
            }
        }
        
        
        if(is_string($password) && trim($password) !== ''){
            $resultUpdatePassword = mysqli_query($connection, $queryUpdatePassword);    

            if (!$resultUpdatePassword){
                $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
                $_SESSION['adminMessageType'] = "errorPopUp";
            }
        }
        
        $_SESSION['adminMessage'] =  "User updated successfully";
        $_SESSION['adminMessageType'] = "successPopUp";
        echo "<script>window.location.href = 'main.php?page=admin';</script>";
    }    

    catch(Exception $e){

    }
?>