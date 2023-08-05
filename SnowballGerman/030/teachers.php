<?php 
    require_once 'load.php';
    $db = new trida();
    $us = new user_repository($db);
    $teacher = $us->GetTeachers();
?>


<!DOCTYPE html>
        <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SnowballGerman Welcome!</title>
        <?php include 'head.php'?>
    </head>
    <body>
        <?php include 'header.php'?>
        <main class="transparent">
            <div class="students">
                <?php foreach($teacher as $s):?>
                <a href="teacherDetail.php?id=<?=$s['id']?>" class="student-content link">
                    <div class="students-element">
                        <h1 class="weight400"><?=$s['name']?></h1>
                        <h1 class="weight400"><?=$s['surname']?></h1>
                    </div>
                </a>
                <?php endforeach;?>   
            </div>
        </main>
        <script type="text/javascript" src="script.js"></script>
        </body>
        </html>