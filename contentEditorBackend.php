<?php session_start(); ?>
<?php

#TODO pagina inicial shinanigans
try{
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "<script>window.location.href = 'index.html';</script>";
}
    
$connection = mysqli_connect('localhost', 'root');
mysqli_select_db($connection,'projetoSI');    

if(!$connection){   
    echo("Connection failed: " . mysqli_connect_error());
    throw new Exception("");    
}

$changeLessonID = $_POST['changeLesson'] ?? '';
$changeCourseID = $_POST['changeCourse'] ?? '';
$action = $_POST['action'] ?? '';

if($action == "deleteCourse"){
    $selectedCourse = $_SESSION['selectedCourse'];
    $queryDeleteCourse = "delete from courses where courseID = $selectedCourse;";
    $queryDeleteCourseLessons = "delete from lessons where courseID = $selectedCourse;";
    $queryDeleteUserCourses = "delete from user_courses where courseID = $selectedCourse;";
    $resultDeleteCourse = mysqli_query($connection, $queryDeleteCourse);
    $resultDeleteCourseLessons = mysqli_query($connection, $queryDeleteCourseLessons);
    $resultDeleteUserCourses = mysqli_query($connection, $queryDeleteUserCourses);

    unset($_SESSION['overrideCourseSelection']);
    if (!$resultDeleteCourse or !$resultDeleteCourseLessons or !$resultDeleteUserCourses){
        echo("Connection failed: " . mysqli_connect_error());
        throw new Exception("");    
    }
    echo "<script>window.location.href = 'main.php';</script>";
}

if($action == "createNewCourse"){
    $newCourseName = $_POST['newCourseName'];
    $querySelectLastID = "SELECT MAX(courseID) AS max_id FROM courses;";
    $resultSelectLastID = mysqli_query($connection, $querySelectLastID);

    if(!$resultSelectLastID){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");    
    }

    $nextID = mysqli_fetch_assoc($resultSelectLastID)['max_id'] + 1;
    $queryAddCourse = "insert into courses values ($nextID, '$newCourseName');";
    $resultAddCourse = mysqli_query($connection, $queryAddCourse);

    if(!$resultAddCourse){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");    
    }
    echo "<script>window.location.href = 'main.php';</script>";
}


if($action == "deleteLesson"){
    $selectedLesson = $_SESSION['selectedLesson'];
    $queryDeleteLesson = "delete from lessons where lessonID = $selectedLesson;";
    $resultDeleteLesson = mysqli_query($connection, $queryDeleteLesson);

    unset($_SESSION['overrideLessonSelection']);
    if (!$resultDeleteLesson){
        echo("Connection failed: " . mysqli_connect_error());
        throw new Exception("");    
    }
    echo "<script>window.location.href = 'main.php';</script>";
}

if($action == "createNewLesson"){
    $newLessonName = $_POST['newLessonName'];
    $querySelectLastID = "SELECT MAX(lessonID) AS max_id FROM lessons;";
    $resultSelectLastID = mysqli_query($connection, $querySelectLastID);
    $selectedCourse = $_SESSION['selectedCourse'];

    if(!$resultSelectLastID){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");
    }

    $nextID = mysqli_fetch_assoc($resultSelectLastID)['max_id'] + 1;
    $queryAddLesson = "insert into lessons values ($nextID, '$newLessonName', \"\", $selectedCourse);";
    $resultAddLesson = mysqli_query($connection, $queryAddLesson);

    if(!$resultAddLesson){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");    
    }
    echo "<script>window.location.href = 'main.php';</script>";
}

if($action == "updateLesson"){
    $editorData = $_POST['editorData'] ?? '';
    $selectedLesson = $_SESSION['selectedLesson'];
    $queryUpdateLesson = "update lessons set lessonContent = '$editorData' where lessonID = $selectedLesson;";
    $resultUpdateLesson = mysqli_query($connection, $queryUpdateLesson);

    if(!$resultUpdateLesson){
        echo("Connection failed: " . mysqli_error($connection));
        throw new Exception("");    
    }
    echo "<script>window.location.href = 'main.php';</script>";
}

if($changeLessonID != ""){
    $_SESSION['overrideLessonSelection'] = $changeLessonID;
    echo "<script>window.location.href = 'main.php';</script>";
}

if($changeCourseID != ""){
    $_SESSION['overrideCourseSelection'] = $changeCourseID;
    unset($_SESSION['overrideLessonSelection']);
    echo "<script>window.location.href = 'main.php';</script>";
}
    
    

}

catch (Exception $e){

}
?>