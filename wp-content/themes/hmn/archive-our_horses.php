<?php
    get_header();
    global $post;
    $termAtual = $terms[0]->slug;
?>

<!-- Topo Geral -->
<div class="fd-header-plantel bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-plantel"></span>

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
							<a href="<?php echo esc_attr(get_term_link($tax_term, $taxonomy)); ?>" <?php if($termSlug == $termAtual){ ?>class="active"<?php } ?>><?php echo $tax_term->name; ?></a>
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
			<h1 class="tilt-internas detal-title">Plantel</h1>
		</div>
	</div>
	<div class="row">
			<?php if (!have_posts()) : ?>
            <div class="col-xs-12">
                <h2 class="text-center">Nenhum cavalo encontrado nesta categoria</h2>
            </div>
        	<?php endif; ?>

        	<?php get_template_part('loop-our_horses'); ?>

			<div class="cf"></div>

		<?php include("inc/paginacao.php"); ?>
	</div>
</div>
<!-- Listagem de galerias -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>