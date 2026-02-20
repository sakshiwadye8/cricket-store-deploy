<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define('SITEURL', 'https://cricket-store-deploy.onrender.com/');

$mysqli = mysqli_init();

mysqli_ssl_set($mysqli, NULL, NULL, NULL, NULL, NULL);

mysqli_real_connect(
    $mysqli,
    'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
    'SjQXduyi66DiXMN.root',
    'jUO6KPFaGvZbpeDQ',
    'cricket_store',
    4000,
    NULL,
    MYSQLI_CLIENT_SSL
);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn = $mysqli;

?>
