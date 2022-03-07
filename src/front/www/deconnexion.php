<?php
session_start();

if (((isset($_SESSION['client'])) and (!empty($_SESSION['client'])))) {
    session_unset();
    session_write_close();
    session_destroy();
}

header('location:./index.php');
?>