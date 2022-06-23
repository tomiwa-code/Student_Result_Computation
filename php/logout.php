<?php
session_start();

if (isset($_SESSION["unique_id"])) {
    session_unset();
    session_destroy();
    echo "LogoutSuccess";
}