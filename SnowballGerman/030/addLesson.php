<?php

require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

$user = $us->getUserById($_GET['id']);

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

if(!isset($_SESSION['user']))
{
    if(isset($_POST['text'],$_POST['hw'], $_GET['id']))
    {
        $ls->addLesson($_POST['text'], $_GET['id'], $_POST['hw'], $user['teacher_id']);
        header('Location: index.php?id=timedout&studentid='.$user['id']);
    }
}

if ($_SESSION['user']['teacher']==1) {
    if(isset($_POST['text'],$_POST['hw'], $_GET['id']))
    {
        if($_POST['text']=="")
        {
            $msg = "<strong style='color:red;'>This field is required!</strong>";
        }
        else 
        {
           // $heading = getContents($_POST['text'], '<h1>', '</h1>');
           // $string = implode("<br>",$heading);
            $ls->addLesson($_POST['text'], $_GET['id'], $_POST['hw'], $_SESSION['user']['id']);
            header('Location: tabularOverview.php?id='.$user['id']);
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
        <title>Add Lesson</title>
        <?php include 'tinymce.php'?>
        <?php include 'head.php'?>
    </head>
    <body>
    <?php include 'header.php'?>
        <main>
        <div class="addLesson">
    
            <form action="" method="post" class="lesson-form">
                <div>
                    <h2 class="center">Add Lesson - <?=$user['name']?> <?=$user['surname']?>  <?php  if(isset($msg)){echo(" - " . $msg);}?></h2>
                </div>
                <div>
                    <textarea name="text" id="myTextarea" placeholder="Notes..."></textarea>       
                </div>
                <div>
                    <h2 class="center homework-title">Homework</h2>
                </div>
                <div id="hw">
                <textarea name="hw" id="myTextarea" placeholder="Homework..."></textarea>   
                </div>
                <div class="middle">
                    <button class="button">Add Lesson</button>
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
    </script>
<?php endif;?>