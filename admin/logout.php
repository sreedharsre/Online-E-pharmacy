<?php

session_start();
session_destroy();
header("location:http://localhost/pharma/index.php");
?>