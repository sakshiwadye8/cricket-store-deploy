<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('SITEURL', 'https://your-render-url.onrender.com/');

$conn = mysqli_connect(
    'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
    'SjQXduyi66DiXMN.root',
    'jUO6KPFaGvZbpeDQ',
    'cricket_store',
    4000
);

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>