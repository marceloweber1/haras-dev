<?php
	get_header();

	global $wp_query;
	$total_results = $wp_query->found_posts;
?>

<div class="container-noticias">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-2 col-xs-12">
				<h1 class="tilt-internas detal-title">Resultado da busca</h1>
			</div>
		</div>
		<div class="row">
			<!-- Listagem de notícias -->
			<div class="col-xs-12">
				<!-- Loop -->
				<?php if($total_results){ ?>
					<?php while (have_posts()) : the_post() ?>
						<?php get_template_part("loop-busca"); ?>
					<?php endwhile; ?>
					<?php include("inc/paginacao.php"); ?>
					<?php } else { ?>
					<p class="nenhum-resultado">Nenhum resultado encontrado.</p>
					<?php } ?>
			</div>
			<!-- Listagem de notícias -->
		</div>
	</div>
</div>

<?php get_footer(); ?>