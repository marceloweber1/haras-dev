<?php
	get_header();
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
						<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12"><span><?php echo $cabecalho; ?></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<div class="container-noticias">
	<div class="container">
		<div class="row">
			<?php
				global $post;
				while ( have_posts() ) : the_post();
				$texto = get_field("texto", $post->ID);
				$foto = get_field("foto", $post->ID);
			?>

			<div class="col-lg-5 col-lg-push-4 col-md-5 col-md-push-4 col-sm-12 col-xs-12">
				<div class="container-single-post">
					<div class="tilt-single-post">
						<h3><?php the_title(); ?></h3>
						<span class="date"><?php the_time('j \d\e F \d\e Y'); ?></span>
					</div>
					<?php if($foto){ ?>
					<div class="container-foto">
						<img src="<?php echo $foto['sizes']['fullPost'] ?>" class="img-responsive" alt="">
					</div>
					<?php } ?>
					<?php echo $texto; ?>
				</div>
			</div>

			<!-- Listagem de notícias -->
			<div class="col-lg-3 col-lg-pull-5 col-md-3 col-md-pull-5 col-sm-6 col-sm-pull-0 col-xs-12">
				<?php include("inc/ultimas-noticias.php"); ?>
			</div>
			<!-- Listagem de notícias -->

			<!-- Sidebar -->
			<div class="col-lg-2 col-lg-push-2 col-md-2 col-md-push-2 col-sm-6 col-sm-push-0 col-xs-12">
				<?php include("inc/sidebar-news.php"); ?>
			</div>
			<!-- Sidebar -->
		</div>
	</div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>