<?php

session_start();

unset($_SESSION['login']);
unset($_SESSION['id_user']);
header("location:index.php");