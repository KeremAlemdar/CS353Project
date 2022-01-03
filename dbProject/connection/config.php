<?php

if(!defined('host')) 
    define('host', 'localhost:3306/');
if(!defined('databaseName')) 
    define('databaseName', 'dbproject');
if(!defined('username')) 
    define('username', 'root');
if(!defined('password')) 
    define('password', '');
$mysqli = new mysqli(host, username, password, databaseName);
if ($mysqli->connect_errno) {
    echo "MYSQL connection failed";
}
// if(!defined('host')) 
//     define('host', 'dijkstra.ug.bcc.bilkent.edu.tr');
// if(!defined('databaseName')) 
//     define('databaseName', 'eylul_caglar');
// if(!defined('username')) 
//     define('username', 'eylul.caglar');
// if(!defined('password')) 
//     define('password', 'GwHo8l2b');
// $mysqli = new mysqli(host, username, password, databaseName);
// if ($mysqli->connect_errno) {
//     echo "MYSQL connection failed";
// }
?>