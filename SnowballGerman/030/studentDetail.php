<?php
require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
$ls = new lesson_repository($db);

$LastLesson = $ls->getLastLesson($_GET['id']);

if(isset($_GET['id']))
{
    $user = $us->getUserByID($_GET['id']);
    $allLessons = $ls->getLessonsByUserId($_GET['id']);

    if($_SESSION['user']['teacher']==0)
    {
        if(isset($_GET['more']))
        {
            $lesson = $ls->getLessonsByUserId($_GET['id']);
        }
        else 
        {
            $lesson = $ls->getTopTenLessonsByUserId($_GET['id']);
        }
    }
    else
    {
        $lesson = $ls->getLessonsByUserId($_GET['id']);
    }
   
}
else
{
    $user = $us->getUserByID($_SESSION['user']['id']);
}


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
    <script src="https://cdn.tiny.cloud/1/ayqu27s0z85wck4is65ekpqjcopw2j6dv97euuaxvrhai9ev/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
     tinymce.init({
      selector: 'textarea',
      toolbar:"",
      menubar: "",
      fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 30pt 36pt',
      spellchecker_language: "off",
      force_br_newlines : true,
      force_p_newlines : false,
      forced_root_block : 'div',
      plugins: ' autoresize',
      autoresize_bottom_margin: 10,
      autoresize_overflow_padding: 0,
      <?php if($_SESSION['user']['teacher']==0):?>
      readonly : 1,
      <?php endif;?>
    });
</script>
<style>
.tox-statusbar {
    display:none !important;
}
.tox-tinymce {
    border:none !important;
}
</style>
</head>
<body>
<?php include 'header.php'?>
<main>
<h1 class="center weight400"><?= $user['name']?> <?= $user['surname']?></a> </h1>
<?php if($_SESSION['user']['teacher']==1 | $_SESSION['user']['admin']==1 ):?>
    <h2 class="center weight400"><a href="tabularOverview.php?id=<?=$user['id']?>" class="button">Tabular overview</a></h2>
<?php endif ?>
<div class="TwoButtons">
    <div class="OneButton margin50">
        <h1 class="weight400">Lessons</h1>
            <?php if($_SESSION['user']['teacher']==1 | $_SESSION['user']['admin']==1 ):?>
                <h2><a href="addLesson.php?id=<?=$user['id']?>" class="link"><i class="fas fa-plus"></i></a></h2>
            <?php endif ?>
        <div class="lessons-content">
            <?php foreach($lesson as $l):?>
                <div class="lesson">
                <a href="lessonDetail.php?id=<?=$l['id']?>" class="link-black"><?=$l['date_form']?></a>
                </div>
            <?php endforeach; ?>

            <?php
            if($_SESSION['user']['teacher']==0)
            {
                if(!isset($_GET['more']))
                {  
                    ?>
                    <div class="lesson">
                        <a href="studentDetail.php?id=<?=$l['user_id']?>&more=1" class="link">Earlier Lessons >></a>
                    </div>  
                    <?php
                }
                else
                {
                    ?>
                    <div class="lesson">
                        <a href="studentDetail.php?id=<?=$l['user_id']?>" class="link">Show less <<</a>
                    </div>  
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="OneButton">
        <h1 class="weight400">Homework</h1>
        <?php if($_SESSION['user']['teacher']==1 | $_SESSION['user']['admin']==1 ):?>
            <h2><a href="#" class="link"><i class="fas fa-plus"></i></a></h2>
        <?php endif ?>
        <div class="homework-content">
            <?php foreach($allLessons as $l):?>
                <div class="hw"><a href="lessonDetail.php?id=<?=$l['id']?>" class="link-black"><?=$l['hw']?></a></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div>
<h1 class="center weight400"> Last Lesson </h1>

<?php foreach($LastLesson as $les):?>
<textarea><?=$les['note']?></textarea>
<h1 class="center weight400 marginTop"> Last Lesson's Homework </h1>
<textarea><?=$les['hw']?></textarea>
<?php endforeach; ?>

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