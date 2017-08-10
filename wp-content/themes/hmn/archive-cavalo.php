<?php
    get_header();
    global $post, $wp_query;
?>

<!-- Topo Geral -->
<div class="fd-header-plantel bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php if($wp_query->query_vars['venda'] == 1){ ?>
					<span class="sprites icon-internas icon-venda"></span>
				<?php }else{ ?>
					<span class="sprites icon-internas icon-plantel"></span>
				<?php } ?>
				<div class="submenu-interno">
					<div class="row">
						<?php include("inc/categorias_cavalo.php"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<?php
	$Titulo = "Plantel";
	if($wp_query->query_vars['venda'] == 1){
		$Titulo = "À Venda";
	}
?>

<!-- Listagem de galerias -->
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-2 col-xs-12">
			<h1 class="tilt-internas detal-title"><?php echo $Titulo; ?></h1>
		</div>
	</div>
	<div class="row">
			<?php if (!have_posts()) : ?>
            <div class="col-xs-12">
                <h2 class="text-center">Nenhum cavalo encontrado nesta categoria</h2>
            </div>
        	<?php endif; ?>

        	<?php get_template_part('loop-cavalo'); ?>

			<div class="cf"></div>

		<?php include("inc/paginacao.php"); ?>
	</div>
</div>
<!-- Listagem de galerias -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>