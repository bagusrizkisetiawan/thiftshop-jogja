<?php

session_start();

unset($_SESSION['id_user_admin']);
unset($_SESSION['login_admin']);

header('location:../../../');