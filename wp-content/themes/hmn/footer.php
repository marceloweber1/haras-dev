	<?php
		$home = new WP_Query('page_id=76');
		while ($home->have_posts()) : $home->the_post();

		$copyright = get_field("copyright");
		$dados_de_contato = get_field("dados_de_contato");
	?>

	<div class="go-top">
		<a href="#" class="sprites ir-topo"></a>
	</div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="logo-footer">
						<a href="<?php echo home_url(); ?>" class="logo-footer">Haras Morada Nova</a>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
					//print_r($dados_de_contato);

					if( have_rows('dados_de_contato') ):
				?>
				<div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0">
					<ul class="list-inline contatos-footer">
						<li>
						<?php
							$a = 1;
							while ( have_rows('dados_de_contato') ) : the_row();
					        	$tipo = get_sub_field('tipo');
					        	$local = get_sub_field('local');
					        	$telefone = get_sub_field('telefone');
					        	$email = get_sub_field('email');
			    		?>
							<?php if($tipo == "tel") {; ?>
							<span class="tel"><?php echo $local ." ". $telefone; ?></span>
							<?php $a++; } ?>
						<?php if($a > 2){ ?></li><?php } ?>

						<?php if($tipo == "mail") { ?>
							<li><a href="mailto:<?php echo $email; ?>" class="email"><?php echo $email; ?></a></li>
						<?php } ?>
						<?php endwhile; ?>
					</ul>

					<div class="menu-footer text-center hidden-xs">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-topo', 'menu_class' => 'list-inline', 'menu_id' => '', 'container' => 'nav', 'container_class' => 'menu-principal' ) ); ?>
					</div>
				</div>
				<?php else : endif; ?>

				<div class="end-footer">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<p><?php echo $copyright; ?></p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<ul class="list-inline midias-sociais">
							<?php
							if( have_rows('icones_redes_sociais') ):

							 	// loop through the rows of data
							    while ( have_rows('icones_redes_sociais') ) : the_row();

							        // display a sub field value
							        $icone_midias_rodape = get_sub_field('icone_midias_rodape');
							        $link_midias_rodape = get_sub_field('link_midias_rodape');
							?>
							<li><a href="<?php echo $link_midias_rodape; ?>" target="_blank"><img src="<?php echo $icone_midias_rodape["sizes"]["iconRedes"]; ?>" alt="Icone rede social"></a></li>
							<?php endwhile; else : endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
 <?php endwhile; ?>