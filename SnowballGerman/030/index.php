<?php 
    require_once 'load.php';
    $db = new trida();
    $us = new user_repository($db);
 
    //Prihlaseni
    if (isset($_POST['email'], $_POST['password']))
    {
        $user = $us->getUserByLogin($_POST['email'], $_POST['password']);

        if($user !== false){
            unset($user['password']);
            $_SESSION['user'] = $user;
            if($user['teacher'] == 0) //Jedná se o žáka
            {
                header('Location: studentDetail.php?id='.$user['id']);
            }
            else if($user['teacher'] == 1) //Jedná se o učitele
            {
                if (isset($_GET['id']) && $_GET['id']=="timedout" && isset($_GET['studentid']))
                {
                    header('Location: tabularOverview.php?id='.$_GET['studentid']);
                }
                else
                    header("Refresh:0");
            }
        }
        else {
            ?><script>alert("Your name or password is wrong!");</script><?php
        }
    }

    /*if (isset($_SESSION['user']) && $_SESSION['user']['teacher']==0 && $_SESSION['user']['admin']==0)
    {
        header('Location: studentDetail.php?id='. $_SESSION['user']['id']);
    }*/

    //Dostan studenty pro ucitele
    if (isset($_SESSION['user']) && $_SESSION['user']['teacher']==1)
    {
        $student = $us->GetStudentsByTeacherId($_SESSION['user']['id']);
    }

    //GDPR
    if (isset($_POST['gdpr']))
    {
        $us->UpdateGDPR($_SESSION['user']['id']);
        $_SESSION['user']['gdpr']=1;
    }
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
<?php if(isset($_SESSION['user'])): ?>
    <?php if($_SESSION['user']['gdpr']==1):?>
        <?php if($_SESSION['user']['teacher']==1): ?>
            <body>
                <?php include 'header.php'?>
                <main class="transparent">
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
            <?php else:?>
                <body>
                <?php include 'header.php'?>
                <?php               
                ?>
                <script type="text/javascript" src="script.js"></script>
            </body>
            </html> 
            <?php endif; ?>
    <?php else:?>
        <body>
            <main class="transparent">
            <div class="form">
                <form action="" method="post" class="registr_form">
                <div>
                    <h1 class="center">Processing of personal data</h1><br>
                    <div class="center">
                            By accepting this form, you allow Snowball German to use and store your private information.<br><br>
                        <strong>Name</strong><br>
                        <strong>Surname</strong> <br>
                        <strong>Email address</strong><br><br>
                    </div>
                </div>
                <input type="hidden" name="gdpr" value="1">
                <div class="middle">
                    <button class="button float-l">Accept</button>
                </div>
                <div class="middle">
                    <div><a href="logout.php" class="button float-r">Logout</a></div>
                </div>
                </form>
            </div>
            </main>
            <script type="text/javascript" src="script.js"></script>
        </body>
        </html> 
    <?php endif; ?>   
<?php else: ?>
    <body>
        <?php include "header.php"?>
        <main class="transparent">        
        <div class="form">
            <?php if(isset($_GET['id']) && $_GET['id']=="timedout"):?>
                <div>
                    <h2 class="center">Your lesson is <span style="color: green;">SAVED</span>!</h2>
                    <p>You have been logged out for security reasons. Don't worry, your lesson is saved! Please log in to continue.</p><br><br>
                </div>
                <?php endif; ?>
                <form action="" method="post" class="registr_form">
                <div>
                    <h2 class="center">Sign in</h2>
                </div>
                <div>
                    <label for="" class="label">Your email</label>
                    <input type="email" name="email" placeholder="Email" class="input" required>
                </div>
                <div>
                    <label for="" class="label">Your password</label>
                    <input type="password" name="password" placeholder="Password" class="input" required>
                </div>
                <div class="middle">
                    <button class="button">Sign in</button>
                </div>
                </form>
        </div>
        </main>
        <script type="text/javascript" src="script.js"></script>
    </body>
    </html>
<?php endif; ?>
