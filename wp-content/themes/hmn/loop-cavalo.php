<?php

	global $query_string;

	$i = 0;
	
	query_posts($query_string . '&orderby=title&order=ASC');
	
	while (have_posts()) : the_post();

        $post = get_post();

        $thumbnail = get_the_post_thumbnail( $post->ID, 'thumbHorses', array( 'class' => 'img-responsive' ) );

        if($thumbnail){
            $midia = $thumbnail;
        }else{
            $midia = '<img src="'.get_stylesheet_directory_uri().'/img/horse_image_notfound.png" class="img-responsive" width="350" height="233">';
        }

        $i++;

        $description = get_field("description");

        // Single post

        $selo = get_selo_cavalo($post->ID);

        $marcadagua = get_field('marca_dagua', $post->ID);
        if(!$marcadagua){
            $marcadagua = 'no';
        }

?>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<a href="<?php the_permalink(); echo $lang; ?>" class="single-galeria">
			<div class="holder-thumb">
                <?php echo $midia; ?>
                <div class="veja-mais"></div>
                <?php if($selo){ ?>
                    <img src="<?php echo $selo; ?>" class="selo selo-<?php echo get_selo_lado($post->ID); ?>" />
                <?php } ?>
                <?php if($marcadagua != 'no'){ ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/marca-dagua.png" class="marcadagua lado-<?php echo $marcadagua; ?>" />
                <?php } ?>
            </div>
			<span class="texto">
				<p><?php the_title(); ?></p>
			</span>
	</a>
</div>

<?php
	endwhile;
?>