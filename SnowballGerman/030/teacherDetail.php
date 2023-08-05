<?php
require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

$user = $us->getUserByID($_GET['id']);
$student = $us->GetStudentsByTeacherId($_GET['id']);

?>
<?php if(isset($_SESSION['user'])):?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$user['name']?> <?=$user['surname']?></title>
    <?php include 'head.php'?>
</head>
<body>
    <?php include 'header.php'?>
    <main class="transparent">
            <h1 class="center weight400"> Teacher: <?= $user['name']?> <?= $user['surname']?></a> </h1>
            <div class="students">
                <?php foreach($student as $s):?>
                <a href="tabularOverview.php?id=<?=$s['id']?>" class="student-content link">
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