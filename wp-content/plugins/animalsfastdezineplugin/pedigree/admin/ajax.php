<?php

if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['parent']) || empty($_POST['parent']) ) {
    die();
}

define('ABSPATH', realpath(dirname(__FILE__) . '/../../../../../').'/');
require(__DIR__ . '/../../../../../wp-config.php');

echo get_post_meta($_POST['id'],$_POST['parent'],true);

exit();