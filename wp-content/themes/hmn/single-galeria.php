<?php
	get_header();
	global $post;
	$terms = get_the_terms($post->id, 'categoria-galeria');
	$termAtual = $terms[0]->slug;
?>

<!-- Topo Geral -->
<div class="fd-header-galeria bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-galerias"></span>

				<div class="submenu-interno">
					<div class="row">
						<?php
							//list terms in a given taxonomy
							$taxonomy = 'categoria-galeria';
							$tax_terms = get_terms($taxonomy);

							$a = 1;
							foreach ($tax_terms as $tax_term) {
								$termSlug = $tax_term->slug;
						?>
						<?php if($a == 1){ ?>
						<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-4 col-xs-12">
						<?php }else{ ?>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<?php } ?>
						<a href="<?php echo esc_attr(get_term_link($tax_term, $taxonomy))?>" <?php if($termSlug == $termAtual){ ?>class="active"<?php } ?>><?php echo $tax_term->name; ?></a>
						</div>
						<?php $a++; } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<!-- Listagem de vídeos -->
<div class="galerias-geral">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-2 col-xs-12">
				<h1 class="tilt-internas detal-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="container-galeria">
			<?php while ( have_posts() ) : the_post(); ?>
				<!-- Loop galeria -->
				<?php echo get_template_part("loop-galeria-interna"); ?>
				<!-- Loop galeria -->
			<?php endwhile; ?>
			<div class="cf"></div>
			</div>
		</div>
		<?php include("inc/paginacao.php"); ?>
	</div>
</div>
<!-- Listagem de vídeos -->

<?php get_footer(); ?>