<?php
/**
 * The header template.
 * 
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	
	<div id="header">
		<h1>
			<?php bloginfo( 'title' ); ?>
		</h1>
		<h2>
			<?php bloginfo( 'description' ); ?>
		</h2>
	</div><!-- #header -->