<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
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
                #TODO verificar se tem sessao iniciada antes de entregar o projeto lol 
                $username = $_SESSION['username'] ?? 'Guest';
                $roleID = $_SESSION['roleID'] ?? 1;
                if($roleID == 1 or $roleID == 2){
                    echo('<div class ="iconContainer" id="contentEditorContainer">
                        <img src="assets/svgs/edit.svg">
                    </div>');
                }
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
            echo("<h1>Hi, $username, ready to start language learning?<h1>");
        ?>
        
    </div>
    <div class="content inactive" id="accountOptionsContent">
        <h1>Account Options</h1>
        <form action="adminBackend.php" method="post" id="logOutForm">
            <button type="submit" name="action" value="logOut" id="logOutAccountOptionsButton">Log Out</button>
        </form>        
    </div>
    
    <div class="content inactive" id="adminContent">
        <h1>Admin Panel</h1>
        <table>
            <thead>
                <tr>
                    <td colspan=2>
                        <form action="adminBackend.php" method="post">
                            <div id="adminTableSearchContainer">
                                <?php
                                    $searchQuery = "";
                                    if(isset($_SESSION['searchQuery'])){
                                        $searchQuery = $_SESSION['searchQuery'];
                                    }   
                                
                                    echo('<input class="searchBox" id="adminTableSearchBox" placeholder="Search" name="search" value= '.$searchQuery.'>')
                                
                                ?>
                                <button type="submit" name="action" value="search"><img src ="assets/svgs/search.svg" id="adminTableSearchIcon"></button>
                            </div>
                        </form></td>
                    <td colspan = 1>
                        <form action="adminBackend.php" method="post">
                            <button type="submit" name="action" value="add" class="adminPanelButton" id="addUserAdminRowButton">Add user</button>        
                        </form>
                    </td>
                </tr>
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


                        if(isset($_SESSION['globalSearchIds'])){
                            

                            foreach($_SESSION['globalSearchIds'] as $rowID){
                                $querySelectUserFromID = "select id, username, name, email, roleID from user where id = $rowID;";
                                $resultSelectUserFromID = mysqli_query($connection, $querySelectUserFromID);
                                
                                if(!$resultSelectUserFromID){
                                    echo("<tr><td colspan='5'>Query failed.</td></tr>");
                                    throw new Exception("");
                                }

                                $userRow = mysqli_fetch_assoc($resultSelectUserFromID);
                                if ($userRow) {
                                    $id       = $userRow['id'] ?? '';
                                    $username = $userRow['username'] ?? '';
                                    $name     = $userRow['name'] ?? '';
                                    $email    = $userRow['email'] ?? '';
                                    $roleID   = $userRow['roleID'] ?? '' ;

                                    
                                    echo '<tr> <form class="adminTableRowN' . $i . '" action="adminBackend.php" method="post">';
                                    echo '<td> <input type="text" class="tableInput" name ="id" value ="' . $id . '" id="tableInputID" readonly></td>';
                                    echo '<td> <input type="text" class="tableInput" name ="username" value ="' . $username . '" id="tableInput"></td>';
                                    echo '<td> <input type="text" class="tableInput" name ="name" value ="' . $name . '" id="tableInputName"></td>';
                                    echo '<td> <input type="text" class="tableInput" name ="email" value ="' . $email . '" id="tableInputEmail"></td>';
                                    echo '<td> <input type="text" class="tableInput" name ="roleID" value ="' . $roleID . '" id="tableInputRoleID"></td>';
                                    echo '<td> <input type="text" class="tableInput" name ="password" placeholder="Change Password"></td>';
                                    echo '<td><button type="submit" name="action" value="update" class="adminPanelButton" id="updateAdminRowButton">Update Row</button></td>';
                                    echo '<td><button type="submit" name="action" value="delete" class="adminPanelButton" id="deleteAdminRowButton"><img src="assets/svgs/trash.svg"></button></td>';
                                    echo '</form>';
                                    echo '</tr>';
                                }


                                $i += 1;
                            }
                            throw new Exception("");
                        }

                        while ($row = mysqli_fetch_assoc($resultTableContents)){
                            $id = $row['id'] ?? '';
                            $username = $row['username'] ?? '';
                            $name = $row['name'] ?? '';
                            $email = $row['email'] ?? '';
                            $roleID = $row['roleID'] ?? '';
                            
                            echo '<tr> <form class="adminTableRowN' . $i . '" action="adminBackend.php" method="post">';
                            echo '<td> <input type="text" class="tableInput" name ="id" value ="' . $id . '" id="tableInputID" readonly></td>';
                            echo '<td> <input type="text" class="tableInput" name ="username" value ="' . $username . '" id="tableInput"></td>';
                            echo '<td> <input type="text" class="tableInput" name ="name" value ="' . $name . '" id="tableInputName"></td>';
                            echo '<td> <input type="text" class="tableInput" name ="email" value ="' . $email . '" id="tableInputEmail"></td>';
                            echo '<td> <input type="text" class="tableInput" name ="roleID" value ="' . $roleID . '" id="tableInputRoleID"></td>';
                            echo '<td> <input type="text" class="tableInput" name ="password" placeholder="Change Password"></td>';
                            echo '<td><button type="submit" name="action" value="update" class="adminPanelButton" id="updateAdminRowButton">Update Row</button></td>';
                            echo '<td><button type="submit" name="action" value="delete" class="adminPanelButton" id="deleteAdminRowButton"><img src="assets/svgs/trash.svg"></button></td>';
                            echo '</form>';
                            echo '</tr>';
                            
                            $i +=1;
                        }
                        

                    }

                    catch(Exception $e){
                    
                    }
        
                    
                    ?>
                    
            </tbody>
        </table>
        <?php
            if (isset($_SESSION['adminMessageType'])){
                $adminMessageType = $_SESSION['adminMessageType'];
            }
            else{
                $adminMessageType = "";
            }

            if (isset($_SESSION['adminMessage'])) {
                echo(' <div class="popUp '.$adminMessageType.'" id="adminPopUp">
                    '.  $_SESSION['adminMessage'] . '
                </div>');
                unset($_SESSION['adminMessage']);
            }
        ?> 
    </div>
    <div class="content inactive" id="contentEditorContent">
        <h1>Content Editor</h1>
        <form method="post" action="contentEditorBackend.php">
            <textarea id="summernote" name="editorData"></textarea>
            <button>Update Stuff type shi</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
