<?php

$conn = mysqli_connect("localhost", "root", "", "mapoly_result");

if(!$conn) {
    echo "connection error";
}