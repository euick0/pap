<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
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
        $roleID = $_POST['roleID'] ?? '';
        $action = $_POST['action'] ?? '';

        $connection = mysqli_connect('localhost', 'root');
        mysqli_select_db($connection,'projetoSI');

        if(!$connection){
            #TODO implementar msg de erro na pagina de admin 
            echo("Connection failed: " . mysqli_connect_error());
            throw new Exception("");    
        }

        $queryCheckUsername  = "select * from user where username = '$username' and roleID = $roleID;";
        $queryCheckEmail = "select * from user where email = '$email' and roleID = $roleID;";
        $queryCheckRoleID = "select * from user where RoleID = '$roleID' and roleID = $roleID;";
        $queryCheckName = "select * from user where name= '$name' and roleID = $roleID;";
        $queryCheckPassword = "select * from user where password= '$password' and roleID = $roleID;";

        $resultCheckEmail = mysqli_query($connection, $queryCheckEmail); 
        $resultCheckUsername = mysqli_query($connection, $queryCheckUsername);
        $resultCheckRoleID = mysqli_query($connection, $queryCheckRoleID);
        $resultCheckName = mysqli_query($connection, $queryCheckName);
        $resultCheckPassword =  mysqli_query($connection, $queryCheckPassword);

        $queryUpdateUsername = "update user set username = '$username' where id = $id;";
        $queryUpdateEmail = "update user set Email = '$email' where id = $id;";
        $queryUpdateName = "update user set Name = '$name' where id = $id;";
        $queryUpdatePassword = "update user set Password = '$password' where id = $id;";
        $queryUpdateRoleID = "update user set RoleID = '$roleID' where id = $id;";

        $queryDeleteUser = "delete from user where id = $id;";
        
        #TODO implementar diferença entre erros e feedback do popup
        
        if ($action == "delete"){
            $resultDeleteUser = mysqli_query($connection, $queryDeleteUser);
            $_SESSION['adminMessage'] = "User $name deleted successfully";
            if (!$resultDeleteUser) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
            echo "<script>window.location.href = 'main.php';</script>";
        }
        
        if($action == "add"){
            $id += 1;
            $queryAddUser = "insert into user (username, name, email, password, roleID) values ('newUserName$id', 'newUser$id', 'newUser$id@email.com','newUserPassword$id', '3')";
            $resultAddUser = mysqli_query($connection, $queryAddUser);
            $_SESSION['adminMessage'] = "New user added successfully";
            if (!$resultAddUser) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
            echo "<script>window.location.href = 'main.php';</script>";
        }

        #TODO implementar mudar os cookies se mudarmos o nosso proprio user

        #se as queries de verificar nao retornarem nada, quer dizer que o admin mudou
        #o seu conteudo, logo temos que altera-las
        if(mysqli_num_rows($resultCheckUsername) == 0 ){
            $resultUpdateUsername = mysqli_query($connection, $queryUpdateUsername);
            if (!$resultUpdateUsername) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
        }
        
        
        if(mysqli_num_rows($resultCheckName) == 0 ){
            $resultUpdateName = mysqli_query($connection, $queryUpdateName);
            if (!$resultUpdateName) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
        }
        
        
        if(mysqli_num_rows($resultCheckEmail) == 0 ){
            $resultUpdateEmail = mysqli_query($connection, $queryUpdateEmail);
            if (!$resultUpdateEmail) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
        }
        
        
        if(mysqli_num_rows($resultCheckRoleID) == 0 ){
            $resultUpdateRoleID = mysqli_query($connection, $queryUpdateRoleID);
            if (!$resultUpdateRoleID) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
        }
        
        
        if(mysqli_num_rows($resultCheckPassword) == 0 and $password != ''){
            $resultUpdatePassword = mysqli_query($connection, $queryUpdatePassword);    
            if (!$resultUpdatePassword) $_SESSION['adminMessage'] =  "Error: " . mysqli_error($connection) . "";
        }
        

        echo "<script>window.location.href = 'main.php';</script>";
    }    

    catch(Exception $e){

    }
?>