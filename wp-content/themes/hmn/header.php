<?php
	$valueTitle = wp_title('', false);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title><?php if($valueTitle){ echo $valueTitle." - "; } ?><?php echo get_bloginfo("name"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="fundo-topo">
		<header class="container">
			<div class="row">
				<div class="col-xs-12">
					<a href="<?php echo home_url(); ?>" class="logo">Haras Morada Nova</a>
				</div>
			</div>
		</header>
	</div>

	<div class="fundo-menu">
		<div class="nav container">
			<div class="row row-menu">
				<div class="visible-xs visible-sm col-xs-8 hamburger">
					<div class="content-icons">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<div class="col-lg-10 col-md-11 col-xs-12 menu-opcoes">
					<!-- Input Busca -->
					<div class="container-busca hidden-lg hidden-md hidden-sm">
						<div class="container">
							<?php echo get_search_form(); ?>
						</div>
					</div>
					<!-- Input Busca -->
					<div class="menu-collpase">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-topo', 'menu_class' => 'list-inline', 'menu_id' => '', 'container' => 'nav', 'container_class' => 'menu-principal' ) ); ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-1 col-xs-4 menu-pesquisa">
					<div class="search pull-right">
						<a href="#" class="sprites icon-busca">Busca</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="detal-menu-interno hidden-xs"></div>

	<!-- Input Busca -->
	<div class="container-busca hidden-xs">
		<div class="container">
			<?php echo get_search_form(); ?>
		</div>
	</div>
	<!-- Input Busca -->