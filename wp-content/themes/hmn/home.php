<?php
	get_header();
	/* Template Name: Home */

	/* Dados Nosso Plantel */
	$titulo_destaque_nosso_plantel = get_field("titulo_destaque_nosso_plantel");
	$foto_destaque_nosso_plantel = get_field("foto_destaque_nosso_plantel");
	$texto_cta_destaque_nosso_plantel = get_field("texto_cta_destaque_nosso_plantel");
	/* Dados Nosso Plantel */

	/* Sobre o Haras */
	$titulo_sobre_o_haras = get_field("titulo_sobre_o_haras");
	$foto_sobre_o_haras = get_field("foto_sobre_o_haras");
	$texto_sobre_o_haras = get_field("texto_sobre_o_haras");
	$botao_sobre_o_haras = get_field("botao_sobre_o_haras");
	/* Sobre o Haras */

	/* Galeria */
	$texto_galeria = get_field("texto_galeria");
	/* Galeria */

?>

<?php if( have_rows('banner') ): ?>
<div class="banner-home">
		<div class="container-banner" style="visibility: hidden;">
			<ul class="slides">
			<?php
				while( have_rows('banner') ): the_row();

				$imagem = get_sub_field('imagem');
				$titulo = get_sub_field('titulo');
				$texto = get_sub_field('texto');
				$texto_cta = get_sub_field('texto_cta');
				$link = get_sub_field('link');
				$abrir_em_uma_nova_janela = get_sub_field('abrir_em_uma_nova_janela');

			?>
				<!-- Single slide -->
				<li style="background: url(<?php echo $imagem["sizes"]["bannerHome"]; ?>) no-repeat;">
					<div class="banner">
						<div class="container">
							<div class="row">
								<div class="col-xs-12">
									<div class="container-chamada">
										<div class="chamada">
											<h3><?php echo $titulo; ?></h3>
											<p class="txt"><?php echo $texto; ?></p>
											<?php if($texto_cta){ ?>
											<a href="<?php echo $link; ?>" class="bt bt-cta" <?php if($abrir_em_uma_nova_janela){ ?>target="_blank"<?php } ?>><?php echo $texto_cta; ?></a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<img src="<?php echo get_template_directory_uri(); ?>/img/blank.gif" width="1920" height="485" alt="" class="img-responsive">
					</div>
				</li>
				<!-- Single slide -->
			<?php endwhile; ?>
			</ul>
			<div class="cf"></div>
		</div>
	</div>
<?php endif; ?>

	<!-- Miolo -->

	<div class="container">
		<?php
			global $post;
			$plantel = get_posts(array(
			    'post_type' => 'leiloes',
			    'posts_per_page' => 1,
			    'numberposts ' => 1,
			));

			if($plantel){
		?>
		<div class="faixa-detaque">
			<div class="row">
				<div class="col-lg-7 col-lg-offset-3 col-md-7 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<?php
						    foreach($plantel as $post){

						    	$sobre = get_field('sobre');
						    	$link = get_field('link');
						?>
							<!-- Evento destaque -->
							<?php if ( has_post_thumbnail( $_post->ID ) ) { ?>
							<?php echo get_the_post_thumbnail( $_post->ID, 'thumbLeilao', array("class" => "img-responsive") ); ?>
							<?php } ?>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
							<h3><?php the_title(); ?></h3>
							<?php if($sobre){ ?>
							<span class="txt-leilao"><?php echo $sobre; ?></span>
							<?php }; ?>
							<?php if($link){ ?>
							<a href="<?php echo $link; ?>" target="_blank">{ mais informações }</a>
							<?php }}; wp_reset_query(); ?>
						</div>
						<!-- Evento destaque -->
					</div>
				</div>
			</div>
		</div>
		<?php }else{ ?>
		<div class="espaco-no-leilao"></div>
		<?php } ?>


		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h4 class="tilt-home detal-title"><?php echo $titulo_destaque_nosso_plantel; ?></h4>

				<div class="plantel-home">
					<img src="<?php echo $foto_destaque_nosso_plantel["sizes"]["destaquePlantel"]; ?>" alt="" class="img-responsive">
				</div>

				<div class="bt-cta-center">
					<a href="<?php echo get_site_url(); ?>/cavalo_categoria/garanhoes/" class="bt bt-cta-inverse cta-home"><?php echo $texto_cta_destaque_nosso_plantel; ?></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="row lista-news-home">
					<div class="col-xs-12">
						<h4 class="tilt-home detal-title">News</h4>
					</div>

				    <?php
					    global $post;
					    $relacionados = get_posts(array(
					        'post_type' => 'clipping',
					        'posts_per_page' => 3,
					        'numberposts ' => 3,
					    ));
					    if(count($relacionados) > 0){
					    	foreach($relacionados as $post){
	    					$foto = get_field("foto", $post->ID);
				    ?>

					<!-- Loop news -->
					<a href="<?php the_permalink(); ?>" class="single-news">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<img src="<?php echo $foto['sizes']['thumbNews'] ?>" class="img-responsive" alt="">
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<h5><?php the_title(); ?></h5>
							<span class="date"><?php the_time('j \d\e F \d\e Y'); ?></span>
							<div class="txt"><?php echo substr($texto, 0,160); ?>...</div>
						</div>
						<div class="cf"></div>
					</a>
					<!-- Loop news -->

					<?php } }; wp_reset_query(); ?>
				</div>
				<div class="bt-cta-center">
					<a href="<?php echo get_post_type_archive_link("clipping"); ?>" class="bt bt-cta-inverse  cta-home">VEJA TODAS AS NOTÍCIAS</a>
				</div>
			</div>
		</div>
	</div>

	<div class="fd-haras text-center" style="background-image: url(<?php echo $foto_sobre_o_haras["sizes"]["bannerHome"]; ?>);">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h5><?php echo $titulo_sobre_o_haras; ?></h5>
					<div class="txt-haras">
						<?php echo $texto_sobre_o_haras; ?>
					</div>
					<a href="<?php echo get_the_permalink("7"); ?>" class="bt bt-cta"><?php echo $botao_sobre_o_haras; ?></a>
				</div>
			</div>
		</div>
	</div>

	<!-- Galerias -->
	<div class="container-galeria">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h5 class="tilt-home detal-title">Galerias</h5>
					<div class="sub-titulo"><?php echo $texto_galeria; ?></div>
				</div>

				<?php
				    global $post;
				    $loopGaleria = get_posts(array(
				        'post_type' => 'galeria',
				        'posts_per_page' => 4,
				        'numberposts ' => 4,
				    ));
				    if(count($loopGaleria) > 0){
				    	foreach($loopGaleria as $post){
    					$foto = get_field("foto", $post->ID);
			    ?>

			    <?php echo get_template_part("loop-galeria"); ?>

				<?php } }; wp_reset_query(); ?>
			</div>
		</div>
	</div>
	<!-- Galerias -->

	<!-- Miolo -->

<?php get_footer(); ?>