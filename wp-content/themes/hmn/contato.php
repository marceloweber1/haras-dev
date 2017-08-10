<?php
	/* Template Name: Contato */
	get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
<!-- Topo Geral -->
<div class="fd-header-contato bg-geral">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-contato"></span>

				<?php if( have_rows('dados_de_contato') ): ?>
				<div class="submenu-interno">
					<div class="row">
						<?php
							$a == 1;
							while ( have_rows('dados_de_contato') ) : the_row();
							$tipo = get_sub_field("tipo");
							$telefone = get_sub_field("telefone");
							$email = get_sub_field("e-mail");

							if($tipo == "telefone"){
								$contato = $telefone;
							}else{
								$contato = $email;
							}
						?>
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 <?php if($a == "3"){ ?>col-md-offset-3 col-sm-offset-3<?php } ?>"><span><?php echo $contato; ?></span></div>
						<?php $a++; endwhile; ?>
					</div>
				</div>
				<?php else : endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->

<!-- Formulário -->
<div class="formulario-contato">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-2 col-xs-12">
				<h1 class="tilt-internas detal-title">Deixe seu recado</h1>
			</div>
		</div>

		<?php the_content(); ?>

	</div>
</div>
<!-- Formulário -->

<!-- Localização -->
<?php if( have_rows('localizacao') ): ?>
<div class="container-localizacao">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="tilt-internas detal-title">Localização</h2>
			</div>
		</div>

		<div class="container-enderecos">
			<div class="row">
				<?php
					$a = 1;
					while ( have_rows('localizacao') ) : the_row();
					$tipo_endereco = get_sub_field("tipo_endereco");
					$endereco = get_sub_field("endereco");
				?>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 <?php if($a == 1){ ?>col-lg-offset-3 col-md-offset-2 col-sm-offset-0<?php } ?>">
					<div class="enderecos">
						<strong><?php echo $tipo_endereco; ?></strong>
						<br>
						<?php echo $endereco; ?>
					</div>
				</div>
				<?php if($a > 1){$a = 1;}else{$a++;}; endwhile; ?>
			</div>
		</div>
	</div>
</div>
<?php else : endif; ?>
<!-- Localização -->

<?php if( have_rows('mapas') ): ?>
<!-- Mapas -->
<div class="container-mapas">
	<?php
		while ( have_rows('mapas') ) : the_row();
		$tipo = get_sub_field("tipo");
		$imagem_mapa = get_sub_field("imagem_mapa");
		$imagem_mapa_popup = get_sub_field("imagem_mapa_popup");
		$mapa_do_google = get_sub_field("mapa_do_google");
						
		if($tipo == "imagem"){
	?>
	<div class="mapa mapa-personalizado" style="background-image: url('<?php echo $imagem_mapa["sizes"]["medium_large"]; ?>');">
		<a href="<?php echo $imagem_mapa_popup["url"]; ?>" class="ampliar lightbox">
			Ampliar
			<span class="sprites icon-ampliar"></span>
		</a>
	</div>
	<?php }else{ ?>
	<div class="mapa mapa-google">
		<div class="acf-map">
			<div class="marker" data-lat="<?php echo $mapa_do_google['lat']; ?>" data-lng="<?php echo $mapa_do_google['lng']; ?>"></div>
		</div>
	</div>
	<?php } ?>
	<?php endwhile; ?>
	<div class="cf"></div>
</div>
<!-- Mapas -->
<?php else : endif; ?>

<?php endwhile; ?>

<?php
	get_footer();
?>