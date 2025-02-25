<?php
$host = "localhost";
$user = "root";
$pwd = "12345678Y";
$db = "shop4612";

$conn = mysqli_connect($host,$user,$pwd)or die("เชื่องต่อฐานข้อมูลไม่ได้"); 
mysqli_select_db ($conn,$db) or die ("เลือกฐานข้อมูลไม่ได้");
mysqli_query($conn, "set names utf8");
?>