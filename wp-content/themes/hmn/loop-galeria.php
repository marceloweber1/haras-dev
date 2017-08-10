<?php
	GLOBAL $post;

	/* Pega todas as taxonomias */
	$taxs = wp_get_post_terms($post->ID, 'categoria-galeria', array("fields" => "all"));
	/* Pega todas as taxonomias */

	/* Pega a primeira categoria */
	$tipoGaleria = $taxs[0]->slug;
	$nomeGaleria = $taxs[0]->name;
	/* Pega a primeira categoria */

	if ($tipoGaleria == "fotos") {
		$galeria_de_fotos = get_field("galeria_de_fotos");
		$imagem = $galeria_de_fotos[0]["sizes"]["thumbGallery"];
	}elseif($tipoGaleria == "videos"){
		$lista_de_videos = get_field("lista_de_videos");
		$video = $lista_de_videos[0]["link"];
		$totalVideos = count($lista_de_videos);
		$parts = parse_url($lista_de_videos[0]["link"]);
		if($parts['host'] == "youtu.be"){
			$videoOk = rtrim(ltrim($parts['path'], "/"), "/");
		}else{
			$queryVideo = array();
			parse_str($parts['query'], $queryVideo);
			$videoOk = $queryVideo['v'];
		}
		$imagem = 'http://img.youtube.com/vi/'.$videoOk.'/0.jpg';
	}else{
		$imagem = ''.get_template_directory_uri().'/images/sem-foto.jpg"';
	}
?>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="single-galeria">
		<a href="<?php if($totalVideos == 1){ echo "http://www.youtube.com/embed/".$videoOk."?autoplay=1"; }else{ the_permalink(); } ?>" <?php if($totalVideos == 1){ ?>class="lightbox fancybox.iframe single-video"<?php } ?>>
			<div class="holder-thumb">
				<img src="<?php echo $imagem; ?>" width="480" alt="Fotos" class="img-responsive">
				<div class="veja-mais"></div>
			</div>
			<div class="texto">
				<span><?php echo $nomeGaleria; ?></span>
				<p><?php the_title(); ?></p>
			</div>
		</a>
	</div>
</div>