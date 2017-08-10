<?php
	GLOBAL $post;

	/* Pega todas as taxonomias */
	$taxs = wp_get_post_terms($post->ID, 'categoria-galeria', array("fields" => "all"));
	/* Pega todas as taxonomias */

	/* Pega a primeira categoria */
	$tipoGaleria = $taxs[0]->slug;
	/* Pega a primeira categoria */

	if ($tipoGaleria == "fotos") {
		$galeria_de_fotos = get_field("galeria_de_fotos");
?>

<?php
	/* Loop imagens */
	foreach( $galeria_de_fotos as $image ){
?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
	<div class="single-galeria">
		<a href="<?php echo $image['sizes']['large'] ?>" class="lightbox single-foto" rel="gallery">
			<div class="holder-thumb">
				<img src="<?php echo $image['sizes']['thumbGallery']; ?>" alt="Fotos" class="img-responsive">
				<div class="veja-mais"></div>
			</div>
		</a>
	</div>
</div>
<?php } ?>

<?php
	}elseif($tipoGaleria == "videos"){
?>
<?php
	/* Loop imagens */
	while ( have_rows('lista_de_videos') ) : the_row();

		$lista_de_videos = get_sub_field("link");

		//print_r($lista_de_videos);

		$video = $lista_de_videos;
		$parts = parse_url($video);
		if($parts['host'] == "youtu.be"){
			$videoOk = rtrim(ltrim($parts['path'], "/"), "/");
		}else{
			$queryVideo = array();
			parse_str($parts['query'], $queryVideo);
			$videoOk = $queryVideo['v'];
		}
		$imagem = 'http://img.youtube.com/vi/'.$videoOk.'/0.jpg';
		$video = 'http://www.youtube.com/embed/'.$videoOk.'?autoplay=1'
?>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
	<div class="single-galeria">
		<a href="<?php echo $video; ?>" class="lightbox fancybox.iframe single-video" rel="gallery">
			<div class="holder-thumb">
				<img src="<?php echo $imagem; ?>" alt="Fotos" class="img-responsive">
				<div class="veja-mais"></div>
			</div>
		</a>
	</div>
</div>

<?php endwhile; } ?>