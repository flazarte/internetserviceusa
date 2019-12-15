<!DOCTYPE HTML>

<html <?php language_attributes(); ?> style="margin-top:0 !important;">

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">



<?php wp_head(); ?>


</head>



<body>

<header>
<section class="menu cid-rtgkU6BJeD" once="menu" id="menu2-d">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="<?php echo get_home_url(); ?>">
                        <img src="<?php bloginfo('stylesheet_directory');?>/assets/images/logo-122x87.png" style="height: 3.8rem;">
                    </a>
                </span>
                
            </div>
        </div>
        <!-- <div class="navbar-buttons mbr-section-btn d-lg-none d-xl-none"><a class="btn btn-sm btn-primary display-4 " href="tel:312-335-9100">
                    <span class="btn-icon mbri-mobile mbr-iconfont mbr-iconfont-btn">
                    </span>
                     312-335-9100</a></div> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            	<?php wp_get_menu_array('Main menu'); ?>

            </ul>
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="tel:312-335-9100">
                    <span class="btn-icon mbri-mobile mbr-iconfont mbr-iconfont-btn">
                    </span>
                     312-335-9100&nbsp;</a></div>

        </div>

    </nav>


</section>


</header>


