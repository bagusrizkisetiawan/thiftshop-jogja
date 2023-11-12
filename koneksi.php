<?php 
session_start();
$koneksi=mysqli_connect('localhost','root','','thriftshop');

$page=@$_GET['page'];
$proses=@$_GET['proses'];

?>