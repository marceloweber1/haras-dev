<?php
GLOBAL $post;
	$texto = get_field("texto", $post->ID);
	$foto = get_field("foto", $post->ID);
	$link = get_permalink($post->ID);
	$titulo = get_the_title($post->ID);
?>

<div class="single-news">
	<div class="row">
		<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
			<a href="<?php echo $link; ?>"><img src="<?php echo $foto['sizes']['thumbNews'] ?>" class="img-responsive" alt="<?php echo $titulo; ?>"></a>
		</div>
		<div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
			<h3><?php echo $titulo; ?></h3>
			<span class="date"><?php the_time('j \d\e F \d\e Y'); ?></span>
			<?php if ($texto){ ?>
			<div class="txt"><?php echo substr(strip_tags($texto), 0, 120); ?>...</div>
			<?php } ?>
			<a href="<?php echo $link; ?>" class="bt bt-cta-inverse">Continue lendo</a>
		</div>
	</div>
	<div class="cf"></div>
</div>