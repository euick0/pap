<?php session_start(); ?>
<?php

#TODO fazer integração das lições
#TODO editar lições e apagá-las
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

$changeCourseID = $_POST['changeCourse'] ?? '';
$editorData = $_POST['editorData'] ?? '';
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

$_SESSION['overrideCourseSelection'] = $changeCourseID;
echo "<script>window.location.href = 'main.php';</script>";

}
catch (Exception $e){

}
?>