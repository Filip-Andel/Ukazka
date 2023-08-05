<?php 
require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

if(isset($_GET['id']))
{
    $lesson = $ls->getLesson($_GET['id']);
}

if(isset($_GET['update']))
{
    $lesson = $ls->getLesson($_GET['update']);
}
?>
<?php if(isset($_SESSION['user'])):?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Lesson detail</title>
        <?php include 'tinymceRO.php'?>
        <style>
        .tox-tinymce {
            border:none !important;
        }
        .mce-spellchecker-word {
            background-image: none !important;
        }
        </style>
        <?php include 'head.php'?>
    </head>
    <body>
    <?php include 'header.php'?>
    <main>
    <div class="lessonDetailHeader">
        <?php if( $_SESSION['user']['teacher'] == 1 ):?>
            <a href="lessonUpdate.php?id=<?=$lesson['id']?>" class="link-update"><i class="fas fa-pen"></i></a>
        <?php endif;?>
            <h1 class=""><?=$lesson['date_form']?></h1>
    
        <?php if($_SESSION['user']['teacher'] == 1 ):?>
            <a href="lessonDelete.php?id=<?=$lesson['id']?>&student=<?=$lesson['user_id']?>" class="link-delete" onclick="return confirm('Are you sure you want to delete this Lesson?');"><i class="fas fa-trash"></i></a>
        <?php endif;?>
    </div>
        
        <div class="lesson-detail-content">
            <textarea>
                <?=$lesson['note']?>
            </textarea>
            <br>
            <br>
                <h1 class="center">Homework</h1>
                <?php if($lesson['hw'] == null):?>
                    <p>Undefined</p>
                <?php else:?>
                    <textarea><?=$lesson['hw']?></textarea>
                <?php endif;?>
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