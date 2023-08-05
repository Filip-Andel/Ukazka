<?php 
require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

if(isset($_GET['id'], $_GET['student']))
{
    $ls->deleteLesson($_GET['id']);
    header('location: studentDetail.php?id='.$_GET['student']);
}