<?php
$autoload = '/vendor/autoload.php';
$up_path = '../../../../..';

// Host environment
if(file_exists($up_path . $autoload)) {
    include $up_path . $autoload;
}
// Docker environment
if(file_exists($autoload)) {
    include $autoload;
}
