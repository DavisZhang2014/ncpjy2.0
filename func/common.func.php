<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}

function dump($data){
    echo "<pre>";
    print_r($data);
}