<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

		<!--[if lt IE 9]>
			<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/ie-style.css">
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
							<img style="margin-bottom:1em; height:5.8em;" data-fallback="<?php echo get_template_directory_uri(); ?>/img/svg/logo.png" src="<?php echo get_template_directory_uri(); ?>/img/svg/logo.svg" alt="Bootblank" >
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
