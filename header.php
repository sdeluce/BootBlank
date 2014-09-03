<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/ie-style.css">
		<![endif]-->
		<script>
			// conditionizr.com
			// configure environment tests
			// conditionizr.config({
			// 	assets: '<?php echo get_template_directory_uri(); ?>',
			// 	tests: {}
			// });
		</script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">

				<div class="container">
					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img style="margin-bottom:1em; height:5.8em;" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="nav" role="navigation">
						<?php bootblank_nav(); ?>
					</nav>
					<!-- /nav -->
				</div>

			</header>
			<!-- /header -->
