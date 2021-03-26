<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Robotak - Exam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="<?php echo assets('exam/lib/flaticon/font/flaticon.css'); ?>" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo assets('exam/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('exam/lib/lightbox/css/lightbox.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo assets('exam/css/style.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo assets('exam/Exam css/css/style.css'); ?>" />
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid position-relative ">
    <nav class="navbar navbar-expand-lg navbar-light py-3 py-lg-0 px-0 px-lg-5">
        <a href="<?php echo url('/'); ?>" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
            <!-- <img src="img\001-letter-r.png" style="height: 80px; "> -->
            <span class="text-primary">روبوتاك</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav font-weight-bold mx-auto py-0">
                <a href="<?php echo url('/about-us'); ?>" class="nav-item nav-link">حول</a>
                <a href="<?php echo url('/team'); ?>" class="nav-item nav-link">الفريق</a>
                <a href="<?php echo url('/contact-us'); ?>" class="nav-item nav-link">تواصل معنا</a>
                <div class="nav-item dropdown">
                    <a href="<?php echo url('/blog'); ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">Blog</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="<?php echo url('/blog'); ?>" class="dropdown-item">Blog</a>
                    </div>
                </div>

    </nav>
</div>
<!-- Navbar End -->
