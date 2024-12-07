<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post Example</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?php echo get_template_directory_uri(); ?>/img/favicon_Dunescrest.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo get_template_directory_uri(); ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
   <?php wp_head(); ?>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center bg-dark px-lg-5">
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-n2">
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#">India | <?php echo date('M j, Y'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="#">Login</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 text-right d-none d-md-block">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-auto mr-n2">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row align-items-center bg-white py-3 px-lg-5">
            <div class="col-lg-8 text-center text-lg-right">
                <h1 class="m-0 display-4 text-uppercase text-primary">Post<span class="text-secondary font-weight-normal">Example</span></h1>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-primary">Post<span class="text-white font-weight-normal">Example</span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
	    <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
<?php
// Get the category slug from the URL
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
?>
                <div class="navbar-nav mr-auto py-0">
         	    <a href="<?php echo home_url(); ?>" class="nav-item nav-link <?php echo (empty($current_category)) ? 'active' : ''; ?>">Home</a>
		    <a href="<?php echo home_url('/topic?category=news_school_events'); ?>" class="nav-item nav-link <?php echo ($current_category == 'news_school_events') ? 'active' : ''; ?>">category1</a>
	            <a href="<?php echo home_url('/topic?category=category1'); ?>" class="nav-item nav-link <?php echo ($current_category == 'news_sports') ? 'active' : ''; ?>">category2</a>
	            <a href="<?php echo home_url('/topic?category=category2'); ?>" class="nav-item nav-link <?php echo ($current_category == 'news_arts') ? 'active' : ''; ?>">category3</a> 
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

