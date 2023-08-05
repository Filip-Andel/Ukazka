<?php

require_once 'load.php';

//session_destroy();

unset($_SESSION['user']);

header('Location: index.php');