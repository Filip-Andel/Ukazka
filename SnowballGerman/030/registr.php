<?php 

require_once 'load.php';
$db = new trida();
$us = new user_repository($db);

$teacher = $us->GetTeachers();
 
if (isset($_POST['name'], $_POST['surname'],$_POST['email'], $_POST['password']))
{
    if ($_SESSION['user']['teacher']==1)
    {
        if($_SESSION['user']['admin'] == 1)
        {
            $author = $us->RegistrUser($_POST['name'], $_POST['surname'],$_POST['email'], $_POST['password'], $_POST['teachers']);
        }
        else
        {
            $author = $us->RegistrUser($_POST['name'], $_POST['surname'],$_POST['email'], $_POST['password'], $_SESSION['user']['id']);
        }
        header('Location: index.php');
    }
   /* $author = $us->getUserByLogin($_POST['email'], $_POST['password']);
    unset($author['password']);
    $_SESSION['user'] = $author;*/
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add student</title>
    <?php include 'head.php'?>
</head>
<body>
<?php include"header.php"?>
<main class="transparent">
    
    <div class="form">
        <form action="" method="post" class="registr_form" onsubmit="return validace()">
            <div>
                <h2 class="center">Add Student</h2>
            </div>
            <div>
                <label for="name">Student's Name</label>
                <input type="text" name="name" class="input" required placeholder="Name">
            </div>
            <div>
                <label for="surname">Student's Surname</label>
                <input type="text" name="surname" class="input" required placeholder="Surname">
            </div>
            <div>
                <label for="username">Student's Email</label>
                <input type="email" name="email" class="input" required placeholder="Email">
            </div>
            <div>
                <label for="passwd">Student's Password</label>
                <input type="password" name="password" class="input" required placeholder="Password">
            </div>
            <?php if($_SESSION['user']['admin'] == 1):?>
                <div>
                <label for="passwd">Student's Teacher</label>
                <select name="teachers" id="teachers" class="input">
                <?php foreach($teacher as $t):?>
                    <option  value=<?=$t['id']?>><?=$t['name']?> <?=$t['surname']?></option>
                <?php endforeach; ?>
                </select>
                </div>
            <?php endif; ?>
            <div class="middle">
            <button class="button">Add student</button>
            </div>
        </form>
    </div>
</main>

<footer>

</footer>   
<script type="text/javascript" src="script.js"></script>
</body>
</html>