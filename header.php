<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title(); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/images/favicon.ico" />

	<!-- all our JS is at the bottom of the page, except for Modernizr. -->
	<script src="<?php bloginfo('template_directory'); ?>/_/js/modernizr-1.7.min.js"></script>

	<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
<a name="top" class="topanchor"></a>
<div>
		<header id="header" class="clearfix">
            <div class="wrap clearfix">
                <div id="headerbody" class="clearfix mmcolumn">
                	<div class="toggle-content clearfix">
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
						<nav role="navigation" id="my-menu">
							<ul class="menu">
								<!--<li><a href="/">Div17 Home</a></li>-->
								<?php wp_nav_menu( array( 
								'theme_location' => 'primary', 
								'container' => false, 
								'items_wrap' => '%3$s', ) ); 
								?>
							</ul>
						</nav>
					<?php } ?>   
					</div>
					<a href="#my-menu" class="menu-toggler"><i class="fa fa-bars"></i><span class="mobilemessage">Site Menu</span></a>
                    <span class="nav"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></span><!-- .nav -->
                    <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name');  ?>" class="site-title"><img src="<?php bloginfo('template_directory'); ?>/_/images/logo-society-text.gif" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h2>   
                </div><!-- #headerbody -->
                
                <div id="sitelogo">
    			     <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>" class="logo"><img src="<?php bloginfo('template_directory'); ?>/_/images/logo-div-17.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h1><!-- .logo -->
                </div><!-- #sitelogo -->
                
            </div><!-- #wrap -->
            <script type="text/javascript">
				jQuery(document).ready(function($) {
				      
			      jQuery("#my-menu").mmenu({
		             classes: "mm-zoom-page mm-zoom-menu mm-zoom-panels",
		         });

			      jQuery("#my-button").click(function() {
			         jQuery("#my-menu").trigger("open.mm");
			      });

			    });

			</script>
		</header>

        <div id="content" class="clearfix">
            <div class="wrap clearfix">