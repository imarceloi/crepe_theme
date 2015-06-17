<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

	<!-- BX SLIDER CSS -->
	<link href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.bxslider.css" rel="stylesheet" />
	
	<!-- GOOGLE WEB FONT -->
	<link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css'>

	<!--CSS CUSTOM-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
</head>

<body <?php body_class(); ?>>
	<aside id="aside" role="banner">
		<div class="inner_header">
			<a href="<?php if (is_front_page()) { echo '#home'; } else {  echo home_url();'/#home' ;} ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="menu_home">
				<img src="<?php echo  get_template_directory_uri(); ?>/assets/img/logo.png ?>" alt="<?php echo home_url(); ?>">
			</a>

			<nav id="main-navigation" class="navbar navbar-default" role="navigation">
				<div class="collapse navbar-collapse navbar-main-navigation">
					<?php
						// CHAMA AS CONFIGURAÇÕES DO OPÇÕES DO TEMA (SOCIA MEDIA)
						$odin_general_opts 	= get_option( 'odin_general' );
						$telefone 			= $odin_general_opts['telefone'];
						$facebook 			= $odin_general_opts['face_input'];
						$twitter 			= $odin_general_opts['twitter_input'];
						$tripadvisor		= $odin_general_opts['trip_input'];
						$foursquare			= $odin_general_opts['four_input'];

						if (is_front_page()) {
							wp_nav_menu(
								array(
									'menu' 			 => 'Menu Principal',
									'depth'          => 2,
									'container'      => false,
									'menu_class'     => 'nav navbar-nav',
									'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
									'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						} else {
							wp_nav_menu(
								array(
									'menu'           => 'Menu Internas',
									'depth'          => 2,
									'container'      => false,
									'menu_class'     => 'nav navbar-nav',
									'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
									'walker'         => new Odin_Bootstrap_Nav_Walker()
								)
							);
						}
					?>
				</div><!-- .navbar-collapse -->
			</nav><!-- #main-menu -->

			<h2 class="siga_nos">Siga-nos</h2>
			<?php if (!empty($facebook)) : ?>
				<a href="<?php echo $facebook ;?>" class="facebook media" target="_blank" title="Facebook"></a>
			<?php endif ;
			if (!empty($twitter)) : ?>
				<a href="<?php echo $twitter ;?>" class="twitter media" target="_blank" title="Twitter"></a>
			<?php endif ;
			if (!empty($tripadvisor)) : ?>
				<a href="<?php echo $tripadvisor ;?>" class="tripadvisor media" target="_blank" title="TripAdvisor"></a>
			<?php endif ;
			if (!empty($foursquare)) : ?>
				<a href="<?php echo $foursquare ;?>" class="foursquare media" target="_blank" title="Foursquare"></a>
			<?php endif ;?>
		</div>
	</aside><!-- #aside -->

	<header class="container header">
		<div class="volta_menu menu">
			<button type="button">
				<span class="icon-bar left"></span>
				<span class="icon-bar right"></span>
			</button>
		</div>
		<div class="menu_retratil menu">
			<button type="button">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<?php if (is_front_page()) : ?>
		<div class="logo_right">
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo  get_template_directory_uri(); ?>/assets/img/logo_right.png ?>" alt="<?php echo home_url(); ?>">
			</a>
		</div>
		<?php endif; ?>
	</header>
	<div id="main" class="site-main">