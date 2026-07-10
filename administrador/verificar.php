<?php

session_start();

if (!isset($_SESSION["admin_id"])) {

    header("Location: ../admlogin.php");
    exit();
}
