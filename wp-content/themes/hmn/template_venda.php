<?php
	/* Template Name: Venda */
    get_header();
    global $post;
    $terms = get_the_terms('our_horses_category-galeria', $post->id);
    $termAtual = $terms[0]->slug;
?>

<!-- Topo Geral -->
<div class="fd-header-plantel bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-venda"></span>

				<div class="submenu-interno">
					<div class="row">
						<?php
							//list terms in a given taxonomy
							$taxonomy = 'our_horses_category';
							$tax_terms = get_terms($taxonomy, array('hide_empty' => false));
							foreach ($tax_terms as $tax_term) {
								$termSlug = $tax_term->slug;
						?>
						<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo esc_attr(get_term_link($tax_term, $taxonomy))?>" <?php if($termSlug == $termAtual){ ?>class="active"<?php } ?>><?php echo $tax_term->name; ?></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<!-- Listagem de galerias -->
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-2 col-xs-12">
			<h1 class="tilt-internas detal-title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="container-galeria">
			<?php if (!have_posts()) : ?>
            <div class="col-xs-12">
                <h2><?php echo __('No itens found for this category', 'FOR'); ?></h2>
            </div>
        	<?php endif; ?>

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<div class="single-galeria">
					<a href="#">
						<div class="holder-thumb">
							<img src="<?php echo get_template_directory_uri(); ?>/img/foto-1-galeria.jpg" alt="Fotos" class="img-responsive">
							<div class="veja-mais"></div>
						</div>
						<span class="texto">
							<p>Nome Cavalo</p>
						</span>
					</a>
				</div>
			</div>

        	<?php //get_template_part('loop-our_horses'); ?>
			<div class="cf"></div>
		</div>
		<?php include("inc/paginacao.php"); ?>
	</div>
</div>
<!-- Listagem de galerias -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>