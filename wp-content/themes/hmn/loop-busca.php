<?php
GLOBAL $post;
global $wp_query;

	$texto = get_field("texto", $post->ID);
	$foto = get_field("foto", $post->ID);

	$thumbnail = get_the_post_thumbnail( $post->ID, 'thumbHorses', array( 'class' => 'img-responsive' ) );

	if($thumbnail){
        $midia = $thumbnail;
    }else{
        $midia = '<img src="'.get_stylesheet_directory_uri().'/img/horse_image_notfound.jpg" class="img-responsive" width="350" height="233">';
    }
?>

<div class="single-news">
	<div class="row">
		<?php if($thumbnail != "" or $foto != ""){ ?>
		<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
			<?php if($midia){ ?>
				<?php echo $midia; ?>
			<?php }else{ ?>
				<img src="<?php echo $foto['sizes']['thumbNews']; ?>" class="img-responsive" alt="">
			<?php } ?>
		</div>
		<?php } ?>

		<?php if($thumbnail != "" or $foto != ""){ ?>
		<div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
		<?php }else{ ?>
		<div class="col-xs-12">
		<?php } ?>
			<h3><?php the_title(); ?></h3>
			<span class="date"><?php the_time('j \d\e F \d\e Y'); ?></span>
			<?php if ($texto){ ?>
			<div class="txt"><?php echo substr($texto, 0,120); ?>...</div>
			<?php } ?>
			<a href="<?php the_permalink(); ?>" class="bt bt-cta-inverse">Continue lendo</a>
		</div>
	</div>
	<div class="cf"></div>
</div>