<?php
include('../config2/constants.php');
@include '../config.php';



if(!isset($_SESSION['admin_name'])){
    header('location:login_form.php');
}
?>





<html>
    <head>
    <title>Food Order Website - Home Page</title>
<link rel="stylesheet" href="../css//admin.css">
    </head>
    <body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home<a></li>
                <li><a href="manage-admin.php">Admin<a></li>
                <li><a href="manage-category.php">Category<a></li>
                <li><a href="manage-food.php">Food<a></li>
                <li><a href="manage-order.php">Order<a></li>
                <li><a href="../logout.php">Logout<a></li>
                <li><a href="../login_form.php">Login<a></li>
                <li><a href="../register_form.php">Register<a></li>
            </ul>
        </div>
        
    </div>
