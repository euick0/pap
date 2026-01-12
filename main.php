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
            $connection = mysqli_connect('localhost', 'root');
                        
            if(!$connection){                   
                echo("Connection failed: " . mysqli_connect_error());   
                throw new Exception("");    
            }
                
            mysqli_select_db($connection,'projetoSI');
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
        <div class="coursesInfoContainer">
            <?php
            try{
            echo("<h1>Hi, $username, ready to start language learning?<h1>");
            $queryGetLessons = "select * from courses;";
            $resultGetLessons = mysqli_query($connection, $queryGetLessons);

            if (!$resultGetLessons){
                echo("Error: " . mysqli_error($connection));   
                throw new Exception("");
            }

            $i = 0;
            while ($row = mysqli_fetch_assoc($resultGetLessons)){
                $courseName = $row['courseName'] ?? '';
                $courseID = $row['courseID'] ?? '';

                echo('<div class="courseInfo">
                <form method="post" action="lessons.php">
                <button type="submit" name="courseID" value="'.$courseID.'">
                <h1>'.$courseName.'</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat commodi deleniti neque, consectetur molestias quis est suscipit excepturi dolor hic dolorum, reiciendis adipisci tempore ut minima inventore? Commodi, fuga temporibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem non veritatis, quaerat quam, iusto quis dignissimos totam dolore doloremque quibusdam magnam ab quae quia. Eos sequi numquam officia reprehenderit!</p>
                </button>
                </form>
            </div>');
                $i +=1;
            }

            

            }
            catch(Exception $e){

            }

            ?>
        </div>
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
        <div id="coursesContainer">
            <div id="coursesRow">
                <?php
                try{
                    
                $connection = mysqli_connect('localhost', 'root');
                mysqli_select_db($connection,'projetoSI');

                if(!$connection){   
                    echo("Connection failed: " . mysqli_connect_error());   
                    throw new Exception("");    
                }

                $querySelectCourses = "select * from courses;";
                $resultSelectCourses = mysqli_query($connection, $querySelectCourses);
                
                if (!$resultSelectCourses){
                    echo("Error: " . mysqli_error($connection));   
                    throw new Exception("");
                }

                if(isset($_SESSION['overrideCourseSelection'])){
                    $overrideCourseSelection = $_SESSION['overrideCourseSelection'];
                }
                
                $i = 1;
                while ($row = mysqli_fetch_assoc($resultSelectCourses)){
                    $courseID = $row['courseID'];
                    $courseName = $row['courseName'];

                    if($i == 1){
                        $selectedText = "selected";
                        $_SESSION['selectedCourse'] = 1;
                    }
                    else{
                        $selectedText = "unselected";
                    }

                    if (isset($overrideCourseSelection) and $overrideCourseSelection != null){
                        if($overrideCourseSelection == $courseID){
                            $selectedText = "selected";
                            $_SESSION['selectedCourse'] = $courseID;
                        }
                        else{
                            $selectedText = "unselected";
                        }
                    }
                    echo('<form method="post" action="contentEditorBackend.php">');
                    echo('<button type="submit" class="courseButton adminPanelButton '.$selectedText.'" name="changeCourse" value="'.$courseID.'">'.$courseName.'</button>');
                    echo('</form>');
                    $i ++;
                }
                
                if (isset($_SESSION['contentEditorMessageType'])){
                    $contentEditorMessageType = $_SESSION['contentEditorMessageType'];
                }
                else{
                    $contentEditorMessageType = "";
                }

                if (isset($_SESSION['contentEditorMessage'])) {
                    echo(' <div class="popUp '.$contentEditorMessageType.'" id="contentEditorPopUp">
                        '.  $_SESSION['contentEditorMessage'] . '
                    </div>');
                    unset($_SESSION['contentEditorMessage']);
                }
                }
                catch( Exception $e){
                }
                ?>
            </div>
            
            <div id="coursesActionsContainer">
                <form method="post" action="contentEditorBackend.php">
                    <button type="submit" name="action" value="deleteCourse">Delete Selected Course and Associated Lessons</button>
                    <input placeholder= "New Course Name" name="newCourseName"></input>
                    <button type="submit" name="action" value="createNewCourse">Create new Course</button>
                </form>
            </div>
            <div id="lessonsRow">
                <?php
                
                $querySelectLessons = "select * from lessons where courseID = ".$_SESSION['selectedCourse'].";";
                $resultSelectLessons = mysqli_query($connection, $querySelectLessons);

                if(!$resultSelectLessons){
                    echo("Connection failed: " . mysqli_error($connection));
                    throw new Exception("");    
                }
                
                if(isset($_SESSION['overrideLessonSelection'])){
                    $overrideLessonSelection = $_SESSION['overrideLessonSelection'];
                }

                $i = 1;
                while ($row = mysqli_fetch_assoc($resultSelectLessons)){
                    $lessonID = $row["lessonID"];
                    $lessonName = $row["lessonName"];
                    
                    if($i == 1){
                        $selectedText = "selected";
                        $_SESSION['selectedLesson'] = $lessonID;
                    }
                    else{
                        $selectedText = "unselected";
                    }

                    if (isset($overrideLessonSelection) and $overrideLessonSelection != null){
                        if($overrideLessonSelection == $lessonID){
                            $selectedText = "selected";
                            $_SESSION['selectedLesson'] = $lessonID;
                        }
                        else{
                            $selectedText = "unselected";
                        }
                    }

                    echo('<form method="post" action="contentEditorBackend.php">');
                    echo('<button type="submit" class="courseButton adminPanelButton '.$selectedText.'" name="changeLesson" value="'.$lessonID.'">'.$lessonName.'</button>');
                    echo('</form>');
                    $i ++;
                }
            ?>
            
            </div>
            <div id="lessonsActionsContainer">
                <form method="post" action="contentEditorBackend.php">
                    <input placeholder= "New Lesson Name" name="newLessonName"></input>
                    <button type="submit" name="action" value="createNewLesson">Create new Lesson</button>
                    <button type="submit" name="action" value="updateLesson" form="summerNoteForm">Update Lesson</button>
                    <button type="submit" name="action" value="deleteLesson">Delete Lesson</button>
                </form>
            </div>
        </div>
        <form method="post" action="contentEditorBackend.php" id="summerNoteForm">
            <?php
            $selectedLesson = $_SESSION['selectedLesson'];
            $queryGetLessonContent = "select lessonContent from Lessons where lessonID = $selectedLesson;";
            $resultGetLessonContent = mysqli_query($connection, $queryGetLessonContent);
            
            if(!$resultGetLessonContent){
                echo("Connection failed: " . mysqli_error($connection));
                throw new Exception("");    
            }

            $lessonContent = mysqli_fetch_assoc($resultGetLessonContent)["lessonContent"] ?? '';
            echo('<textarea id="summernote" name="editorData" ">'.$lessonContent.'</textarea>')
            ?>

            
        </form>

        <form method="post" action="contentEditorBackend.php"></form>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
