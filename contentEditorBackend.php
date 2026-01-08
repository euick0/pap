<?php session_start(); ?>
<?php
try{
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "<script>window.location.href = 'index.html';</script>";
}

$editorData = $_POST['editorData'];




}
?>