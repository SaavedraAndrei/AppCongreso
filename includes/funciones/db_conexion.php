<?php

$conn = new mysqli('localhost', 'root', 'root', 'appcongreso');
$conn->set_charset('utf8');
if ($conn->connect_error) {
    echo $error->$conn->connect_error;
}
