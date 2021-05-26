<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package videonow-pro
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="true">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if (get_theme_mod('favicon', '') != null) { ?>
<link rel="icon" type="image/png" href="<?php echo esc_url( get_theme_mod('favicon', '') ); ?>" />
<?php } ?>
<?php wp_head(); ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header <?php if(get_theme_mod('header-fixed-on', true)) { echo 'fixed-header'; }; ?>">

		<div class="site-branding">

			<?php if (get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png') != null) { ?>
			
			<div id="logo">
				<span class="helper"></span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_theme_mod('logo', get_template_directory_uri().'/assets/img/logo.png'); ?>" alt=""/>
				</a>
			</div><!-- #logo -->

			<?php } else { ?>

			<div class="site-title">
				<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			</div><!-- .site-title -->

			<?php } ?>

		</div><!-- .site-branding -->

		<nav id="primary-nav" class="main-navigation">

			<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu' ) );
				} else {
			?>

				<ul class="sf-menu">
					<li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php echo __('Add menu for theme location: Primary Menu', 'videonow-pro'); ?></a></li>
				</ul><!-- .sf-menu -->

			<?php } ?>

		</nav><!-- #primary-nav -->

		<div id="slick-mobile-menu"></div>		

		<?php if ( get_theme_mod('header-search-on', true) ) : ?>

			<span class="search-icon">
				<span class="genericon genericon-search"></span>
				<span class="genericon genericon-close"></span>			
			</span>
				
			<div class="header-search">
				<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" class="search-input" placeholder="Search" autocomplete="off">
					<button type="submit" class="search-submit"><span class="genericon genericon-search"></span></button>		
				</form>
			</div><!-- .header-search -->

		<?php endif; ?>

	</header><!-- #masthead -->

	<?php if(get_theme_mod('header-fixed-on', true)) { ?>

		<div id="start">
		</div>
		
	<?php } ?>

	<?php dynamic_sidebar( 'header-ad' ); ?>

	<div id="content" class="site-content clear">
