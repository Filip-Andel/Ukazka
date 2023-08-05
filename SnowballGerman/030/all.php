<?php 
    require_once 'load.php';
    $db = new trida();
    $us = new user_repository($db);
    $ls = new lesson_repository($db);
    if(isset($_SESSION['user']))
    {
        $lesson = $ls->getLessonForEachStudent($_SESSION['user']['id']);
    }
?>

<?php if(isset($_SESSION['user'])):?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All</title>
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
<?php 
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
?>
<body>
<?php include 'header.php'?>
    <main class="tb-main">
    <div class="table">
            <div class="tabular">
            <div class="save-all-div">
                <h1 class="name"></h1>
                <button type="submit" class="save-all" form="myform">Save All</button>
            </div>
                <div class='whole-table-head'>
                    <div></div>
                    <div class="scale">Homework</div>
                    <div class="scale">Lesson</div>
                    <?php if($_SESSION['user']['teacher']==1):?>
                    <div class="scale">Next Lesson</div>
                    <?php endif;?>
                    <?php if($_SESSION['user']['teacher']==0):?>
                    <div class="scale">Detail</div>
                    <?php endif;?>
                </div>
                <hr>
                <form method="post" id="myform">
                <?php foreach($lesson as $l):?>  
                    <?php     $student = $us->getUserById($l['user_id']);?>
                        <div class="whole-table-all">
                            <div class="tb-date">
                                <p class="vertical">
                                    <a href="tabularOverview.php?id=<?=$l['user_id']?>" class="link-black"><?=$student['name']?></a> <br>  
                                    <a href="lessonDetail.php?id=<?=$l['id']?>" class="link-black"><?=$l['date_form']?></a>
                                </p>
                            </div>
                            
                            <div class="homework-table">
                                <?php if($l['hw'] == null):?>
                                    <textarea name="<?=$l['id'] . "#1"?>" placeholder="Undefined">
                                    </textarea>
                                <?php else:?>
                                    <textarea name="<?=$l['id'] . "#1"?>">
                                        <?=$l['hw']?>
                                    </textarea>
                                <?php endif;?>
                            </div>

                            <?php if($_SESSION['user']['teacher']==1 | $_SESSION['user']['admin']==1 ):?>
                                <div class="table-table">
                                    <textarea name="<?=$l['id'] . "#2"?>">
                                        <?php 
                                           $string2 = $l['note'];
                                           $heading2= getContents($string2, '<h1 style="color: blue;">', '</h1>');  
                                           $heading3= getContents($string2, '<h1>', '</h1>');                                            
                                        ?>
                                        <?php if($l['heading']==null):?>
                                            <?php foreach($heading2 as $h) :?>
                                                <div><?=$h?></div> 
                                            <?php endforeach;?>
                                            <?php foreach($heading3 as $h) :?>
                                                <div><?=$h?></div> 
                                            <?php endforeach;?>
                                        <?php else:?>
                                            <?=$l['heading']?>
                                        <?php endif;?>
                                    </textarea>
                                </div>
                                <div  class="table-table">
                                    <?php if($l['plan'] == null):?>
                                        <textarea name="<?=$l['id'] . "#3"?>" placeholder="Undefined">
                                        </textarea> 
                                    <?php else:?>
                                        <textarea name="<?=$l['id'] . "#3"?>">
                                            <?=$l['plan']?>
                                        </textarea> 
                                    <?php endif;?>
                                </textarea>
                                </div>
                            <?php endif;?>
                        </div>
                        <hr>
                        <?php
                        if(isset($_POST[$l['id'] .'#2']))
                        {
                            foreach($lesson as $l):
                            {
                                $ls->updateLessonV2($l['id'],$_POST[$l['id'] .'#2'],$_POST[$l['id'] .'#3'], $_POST[$l['id'] .'#1']);
                                ?>  <script> location.replace("all.php"); </script> <?php
                            }
                            endforeach;
                        }
                        ?>  
                     
                <?php endforeach;?>
                <?php
                /*if(!isset($_GET['more']))
                {
                   ?> 
                    <div class="show-button-div">
                        <a href="tabularOverview.php?id=<?=$l['user_id']?>&more=1" class="show-button">Show all lessons</a>
                    </div>
                   <?php
                }
                if(isset($_GET['more']))
                {
                   ?>
                    <div class="show-button-div">
                        <a href="tabularOverview.php?id=<?=$l['user_id']?>" class="show-button">Show less lessons</a>
                    </div> 
                   <?php
                }*/
                ?>
                </form> 
            </div>
    </main>
</body>
<script type="text/javascript" src="script.js"></script>
</html>
<?php else:?>
    <script>
        alert("You are not logged in!");
        window.location.href = "index.php";
    </script>
<?php endif;?>