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
<div class="content">
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
    #TODO dar redirected a pagina se houver override ou outros
    #TODO mostrar erros e alladat
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
    }
    catch( Exception $e){

    }
?>
</div>

<script ="main.js"></script>
</body>
</html>