<?php
session_start();

if($_GET["accion"] == "logout")
{
    session_destroy();
    header("Location: Login.php");
}

