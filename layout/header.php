<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="public/vendor/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/vendor/fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<?php global $c;?>

<body>
    <div class="container" style="margin-top:20px;">
        <a href="/" class="<?= $c == 'student'?'active':'' ?> btn btn-info">Students</a>
        <a href="?c=subject" class="<?= $c == 'subject'?'active':'' ?> btn btn-info">Subject</a>
        <a href="?c=register" class="<?= $c == 'register'?'active':'' ?> btn btn-info">Register</a>
        <?php require 'layout/message.php' ?>