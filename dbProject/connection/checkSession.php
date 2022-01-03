<?php
include("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['cid'])) {
    // header("location: index.php");
}
// include("config.php");
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// if (!isset($_SESSION['user_id'])) {
//     header("location: login.php");
// }
?>