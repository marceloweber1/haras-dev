<div class="container-sidebar">
	<div class="sidebar text-center">
		<h5 class="tilt-internas detal-title">Últimas Notícias</h5>
	</div>
	<div class="interno-sidebar">
	<div class="row">
	    <?php
		    global $post;
		    $relacionados = get_posts(array(
		        'post_type' => 'clipping',
		        'posts_per_page' => 10,
		        'numberposts ' => 10,
		        'exclude' => $post->ID
		    ));
		    if(count($relacionados) > 0){
	    ?>
	    <?php
	    	$a = 1;
	    	foreach($relacionados as $post){

	    		$foto = get_field("foto", $post->ID);
		?>
		<!-- Loop news -->
		<a class="single-news" href="<?php the_permalink(); ?>">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<img src="<?php echo $foto['sizes']['thumbNews'] ?>" class="img-responsive" alt="">
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<h5><?php the_title(); ?></h5>
				<span class="date"><?php the_time('j \d\e F \d\e Y'); ?></span>
			</div>
			<div class="cf"></div>
		</a>
		<!-- Loop news -->
	    <?php $a++; } ?>
	    <?php } wp_reset_query(); wp_reset_postdata(); ?>
	   	</div>
	</div>
</div>