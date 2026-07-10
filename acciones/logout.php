<?php

session_start();

session_destroy();

header("Location: acciones/admlogin.php");

exit();
