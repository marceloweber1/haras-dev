<?php
	/* Template name: O Haras */
	include("header.php");
?>

<?php
	$home = get_post(4101);
	$cabecalho = get_field("cabecalho", $home->ID);
?>
<!-- Topo Geral -->
<div class="fd-header-haras bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-news"></span>

				<div class="submenu-interno">
					<div class="row">
						<div class="col-lg-6 col-lg-offset-3 col-md-6 col-offset-md-3 col-sm-8 col-offset-sm-2 col-xs-12"><span><?php echo $cabecalho; ?></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-noticias">
	<div class="container">
		<div class="row">
			<!-- Listagem de notícias -->
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				<!-- Loop -->
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part("loop-noticias"); ?>
				<?php endwhile; ?>
			</div>
			<!-- Listagem de notícias -->

			<!-- Sidebar -->
			<div class="col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1 col-sm-4 col-xs-12">
				<?php include("inc/sidebar-news.php"); ?>
			</div>
			<!-- Sidebar -->
		</div>

		<div class="row">
			<div class="col-xs-12">
				<?php include("inc/paginacao.php"); ?>
			</div>
		</div>
	</div>
</div>

<?php
	include("footer.php");
?>