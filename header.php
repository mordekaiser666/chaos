<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title><?php if( is_home() ) bloginfo( 'name' ); else wp_title( '' ); ?></title>
	<!-- material icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<!--/ end material icons -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	    
