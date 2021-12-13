<?php
if(!defined('host')) 
    define('host', 'dijkstra.ug.bcc.bilkent.edu.tr');
if(!defined('databaseName')) 
    define('databaseName', 'kerem_alemdar');
if(!defined('username')) 
    define('username', 'kerem.alemdar');
if(!defined('password')) 
    define('password', '2d18yHIu');
$mysqli = new mysqli(host, username, password, databaseName);
if ($mysqli->connect_errno) {
    echo "MYSQL connection failed";
}
?>