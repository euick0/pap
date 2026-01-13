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
        <a href="main.php?page=main" class ="iconContainer" id="logoIconContainer">
            <img src="assets/svgs/Reqal Logo - Dark Mode.svg">
        </a>
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
                    <a href="main.php?page=editor" class ="iconContainer" id="logoIconContainer">
                        <img src="assets/svgs/edit.svg">
                    </a>
                </div>');
            }
            if($roleID == 1) {
                echo('<div class ="iconContainer" id="adminIconContainer">
                    <a href="main.php?page=admin" class ="iconContainer" id="logoIconContainer">
                        <img src="assets/svgs/protect.svg">
                    </a>
                </div>');
            }
        ?>
        
    </div>
    <div class="bottomIcons">            
        <div class ="iconContainer" id="accountOptionsIconContainer">
            <a href="main.php?page=account" class ="iconContainer" id="logoIconContainer">
                <img src="assets/svgs/menu.svg">
            </a>
        </div>
    </div>
</aside>
<div class="content lessonsContainer">
<?php
try{
    $connection = mysqli_connect('localhost', 'root');
    mysqli_select_db($connection,'projetoSI');

    if(!$connection){   
        echo("Connection failed: " . mysqli_connect_error());   
        throw new Exception("");    
    }

    if (isset($_POST['courseID'])) {
        // ta a vir do post
        $courseID = $_POST['courseID'];
        $_SESSION['activeCourseID'] = $courseID;
        unset($_SESSION['overrideLessonSelection']); 
    } elseif (isset($_SESSION['activeCourseID'])) {
        // ta a vir do backend
        $courseID = $_SESSION['activeCourseID'];
    } else {
        echo "<script>window.location.href = 'main.php';</script>";
        exit();
    }

    $querySelectLessons = "select * from lessons where courseID = ".$courseID.";";
    $resultSelectLessons = mysqli_query($connection, $querySelectLessons);

    if(!$resultSelectLessons){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");    
    }
    
    if(isset($_SESSION['overrideLessonSelection'])){
        $overrideLessonSelection = $_SESSION['overrideLessonSelection'];
    }

    $i = 1;
    $selectedLessonContent = "";
    
    echo('<div class="lessonsList">');
    while ($row = mysqli_fetch_assoc($resultSelectLessons)){
        $lessonID = $row["lessonID"];
        $lessonName = $row["lessonName"];
        
        if($i == 1){
            $selectedText = "lessonSelected";
            $_SESSION['selectedLesson'] = $lessonID;
        }
        else{
            $selectedText = "lessonUnselected";
        }
        if (isset($overrideLessonSelection) and $overrideLessonSelection != null){
            if($overrideLessonSelection == $lessonID){
                $selectedText = "lessonSelected";
                $_SESSION['selectedLesson'] = $lessonID;
            }
            else{
                $selectedText = "lessonUnselected";
            }
        }

        if ($selectedText == "lessonSelected") {
            $selectedLessonContent = $row['lessonContent'];
        }
        echo('<form method="post" action="contentEditorBackend.php">');
        echo('<button type="submit" class="lessonButton adminPanelButton '.$selectedText.'" name="changeUserLesson" value="'.$lessonID.'">'.$lessonName.'</button>');
        echo('</form>');
        $i ++;
    }
    echo('</div>');
    echo("<div class=\"lessonContentContainer\">$selectedLessonContent</div></div>");
    
    }
    catch( Exception $e){

    }
?>

<script src= "lessons.js"></script>
</body>
</html>