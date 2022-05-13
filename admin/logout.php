<?php
    session_start();
    unset($_SESSION['admin-guide-cfcim']);
    header('location:index.php');
?>