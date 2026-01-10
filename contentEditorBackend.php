<?php session_start(); ?>
<?php

#TODO fazer integração dos cursos e criação deles
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

    
    echo "<script>window.location.href = 'main.php';</script>";

}

$_SESSION['overrideCourseSelection'] = $changeCourseID;
echo "<script>window.location.href = 'main.php';</script>";


}
catch (Exception $e){

}
?>