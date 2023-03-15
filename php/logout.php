<?php
    session_start();
    session_destroy();
    setcookie("username", "", time() - 4600, "/");
    header('location: ../index.html');
?>