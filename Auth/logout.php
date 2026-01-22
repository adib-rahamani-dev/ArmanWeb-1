<?php 

session_start();
require_once '../helper/helper-functions.php';
require_once '../helper/data-base.php';


session_destroy();
redirect('index.html');

?> 