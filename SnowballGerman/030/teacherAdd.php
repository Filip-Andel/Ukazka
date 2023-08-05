<?php 

require_once 'load.php';
$db = new trida();
$us = new user_repository($db);
 
if (isset($_POST['name'], $_POST['surname'],$_POST['email'], $_POST['password']))
{
    if ($_SESSION['user']['teacher']==1)
    {
        $author = $us->RegistrTeacher($_POST['name'], $_POST['surname'],$_POST['email'], $_POST['password'], $_SESSION['user']['id']);
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
    <title>Add teacher</title>
    <?php include 'head.php'?>
</head>
<body>
<?php include"header.php"?>
<main class="transparent">
    
    <div class="form">
        <form action="" method="post" class="registr_form" onsubmit="return validace()">
            <div>
                <h2 class="center">Add Teacher</h2>
            </div>
            <div>
                <label for="name">Teacher's Name</label>
                <input type="text" name="name" class="input" required placeholder="Name">
            </div>
            <div>
                <label for="surname">Teacher's Surname</label>
                <input type="text" name="surname" class="input" required placeholder="Surname">
            </div>
            <div>
                <label for="username">Teacher's Email</label>
                <input type="email" name="email" class="input" required placeholder="Email">
            </div>
            <div>
                <label for="passwd">Teacher's Password</label>
                <input type="password" name="password" class="input" required placeholder="Password">
            </div>
            <div class="middle">
            <button class="button">Add teacher</button>
            </div>
        </form>
    </div>
</main>

<footer>

</footer>   
<script type="text/javascript" src="script.js"></script>
</body>
</html>