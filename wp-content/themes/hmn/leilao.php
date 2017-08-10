<?php
	/* Template name: Leilão */
	get_header();

	$titulo = get_the_title();
?>

<!-- Topo Geral -->
<div class="fd-header-haras bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-o-haras"></span>

				<div class="submenu-interno">
					<?php echo do_shortcode('[wpb_childpages]'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="tilt-internas detal-title"><?php echo $titulo; ?></h1>
		</div>
	</div>

<?php while ( have_rows("modelo") ) : the_row(); ?>

<?php
	if(get_row_layout() == "apresentacao"){

		$imagem = get_sub_field('imagem');
		$chamada = get_sub_field('chamada');
		$texto = get_sub_field('texto');
?>
<!-- Apresentação -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<img src="<?php echo $imagem['sizes']['sedeHaras']; ?>" alt="" class="img-responsive">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="txt-interno">
				<div class="chamada">
					<?php echo $chamada; ?>
				</div>
				<div class="geral">
					<?php echo $texto; ?>
				</div>
			</div>
		</div>
	</div>

<!-- Apresentação -->
<?php } ?>

<?php
	if(get_row_layout() == "galeria_geral") {
		$images = get_sub_field('galeria_de_fotos_geral');
?>

	<div class="galeria-haras">
		<div class="row">
			<div class="col-xs-12">
				<div class="slider-haras">
					<?php foreach( $images as $image ): ?>
					<div class="item">
						<a href="<?php echo $image['sizes']["large"]; ?>" class="lightbox single-foto" rel="gallery">
							<div class="holder-thumb">
								<img src="<?php echo $image['sizes']["galeriaEquipe"];?>" alt="" class="img-responsive">
								<div class="veja-mais"></div>
							</div>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

<?php } ?>

<?php
	if(get_row_layout() == "texto_corrido") {
		$content_texto_corrido = get_sub_field('content_texto_corrido');
?>

	<div class="galeria-haras">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $content_texto_corrido; ?>
			</div>
		</div>
	</div>

<?php } ?>

<?php endwhile; ?>
</div>

<?php
	get_footer();
?>