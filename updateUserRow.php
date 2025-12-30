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

        $connection = mysqli_connect('localhost', 'root');
        mysqli_select_db($connection,'projetoSI');

        $queryCheckUsername  = "select * from user where username = '$username'";
        $queryCheckEmail = "select * from user where email = '$email'";
        $queryCheckRoleID = "select * from user where RoleID = '$RoleID'";
        $queryCheckName = "select * from user where name= '$Name'";

        $resultEmail = mysqli_query($connection, $queryCheckEmail); 
        $resultUsername = mysqli_query($connection, $queryCheckUsername);
        $resultRoleID = mysqli_query($connection, $queryCheckRoleID);
        $resultName = mysqli_query($connection, $queryCheckName);



        
        }

        
            
    catch(Exception $e){

    }





?>