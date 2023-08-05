<?php 

require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

$lesson = $ls->getLesson($_GET['id']);

function getContents($str, $startDelimiter, $endDelimiter) {
    $contents = array();
    $startDelimiterLength = strlen($startDelimiter);
    $endDelimiterLength = strlen($endDelimiter);
    $startFrom = $contentStart = $contentEnd = 0;
    while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
        break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
    }
    return $contents;
}

if($_SESSION['user']['teacher']==1)
{
    if(isset($_POST['text']))
    {
        if($_POST['text']=="")
        {
            $msg = "<strong style='color:red;'>This field is required!</strong>";
        }
        else
        {
            $heading = getContents($_POST['text'], '<h1>', '</h1>');
            $string = implode("<br>",$heading);
            $ls->updateLesson($_GET['id'], $_POST['text'], $_POST['plan']);
            header('location: lessonDetail.php?update='.$_GET['id']);
        }
    }
}

?>
<?php if(isset($_SESSION['user'])):?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LessonUpdate</title>
    <?php include 'tinymce.php'?>
    <?php include 'head.php'?>
</head>
<body>
<?php include 'header.php'?>
<main>
    <div class="addLesson">
        <form action="" method="post" class="lesson-form" onsubmit="">
            <div>
                <h2 class="center">Edit Lesson<?php  if(isset($msg)){echo(" - " . $msg);}?></h2>
            </div>
            <div>
                <textarea name="text" id="myTextarea" placeholder="Notes..." required><?=$lesson['note']?></textarea>       
            </div>
            <br>
            <br>
            <div>
                <h2 class="center">Home work</h2>
            </div>
            <div>
                <textarea name="plan" id="" placeholder="Home work"><?=$lesson['hw']?></textarea>       
            </div>
            <div class="middle">
                <button class="button">Edit Lesson</button>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php else:?>
    <script>
        alert("You are not logged in!");
        window.location.href = "index.php";
    </script>
<?php endif;?>