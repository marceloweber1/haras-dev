<?php
    get_header();

    global $post;

    $url = get_bloginfo('url');

    $cavalo = get_post();

    $abccmm = get_field("association_number");
    if(!$abccmm){
        $abccmm = " - ";
    }

    $upload_dir = wp_upload_dir();
    $base = $upload_dir['baseurl'];

    $semImage = get_template_directory_uri()."/img/no_image_quadrado.jpg";

    $selo = get_selo_cavalo($post->ID);

    $gender = get_field("gender");

    $nascimento = get_field("date_birth");
    if(!$nascimento){
        $nascimento = " - ";
    }

    $pelugem = get_field("color");
    if(!$pelugem){
        $pelugem = " - ";
    }

    $sobre = get_field("description");
    if(!$sobre){
        $sobre = " - ";
    }

    $pai = get_post_meta($cavalo->ID, 'father', true);
    $mae = get_post_meta($cavalo->ID, 'mother', true);

    if($pai){
        $pai = get_post($pai);
    }

    if($mae){
        $mae = get_post($mae);
    }

    if($pai){
        $nomePai = $pai->post_title;
        $thumbPai = wp_get_attachment_image_src( get_post_thumbnail_id($pai->ID), 'thumbHorses2' );
        $urlPai = $pai->ID;
    }

    if($mae){
        $nomeMae = $mae->post_title;
        $thumbMae = wp_get_attachment_image_src( get_post_thumbnail_id($mae->ID), 'thumbHorses2' );
        $urlMae = $mae->ID;
    }

    if(!$thumbMae){
        $thumbMaeOk = $semImage;
    }else{
        $thumbMaeOk = $thumbMae[0];
    }

    if(!$thumbPai){
        $thumbPaiOk = $semImage;
    }else{
        $thumbPaiOk = $thumbPai[0];
    }

    $marcadagua = get_field('marca_dagua', $post->ID);
    if(!$marcadagua){
        $marcadagua = 'no';
    }

?>

<section class="fd-miolo fd-single">
<!-- Topo Geral -->
<div class="fd-header-plantel bg-geral hidden-xs">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span class="sprites icon-internas icon-plantel"></span>

				<div class="submenu-interno">
					<div class="row">
						<?php include("inc/categorias_cavalo.php"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Topo Geral -->
<?php global $post; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="tilt-cavalo">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="tilt-internas detal-title"><?php the_title(); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <!-- Foto da galeria -->
                <?php
                    $images = get_field('gallery');
                    if(!is_array($images)){
                        $images = array();
                    }
                    // Conta o total de imagens vindas da galeria. Se for maior que 1 exibe as miniaturas de navegação
                    $total = count($images);

                    $image = $images[0];

                if($image){
                ?>
                <div id="slider" class="container-foto-cavalo" style="visibility: hidden;">
                	<?php if($selo){ ?>
                        <img src="<?php echo $selo; ?>" class="selo selo-<?php echo get_selo_lado($post->ID); ?>" />
                    <?php } ?>
                	<div class="container-gal-horse">
                    <ul class="slides">
                        <?php foreach ($images as $image):
                            if(!is_array($image)){
                                $img = wp_get_attachment_image($image, "PrincipalCavalo2");
                            }else{
                                $img = '<img src="'.$image['sizes']['PrincipalCavalo2'].'" alt="'.$image['alt'].'" class="thumb img-responsive" />';
                            } ?>
                        <li>
                            <?php echo $img; ?>
                            <?php if($marcadagua != 'no'){ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/marca-dagua.png" class="marcadagua lado-<?php echo $marcadagua; ?>" />
                            <?php } ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    </div>
                </div>

                <h2 class="tilt-internas detal-title single-plantel-secundario">Fotos</h2>

                <!-- Foto da galeria -->
                <?php if($total > 1){ ?>
                <div id="carousel" class="sliderHorse">
                	<div class="container-gal-horse" style="visibility: hidden;">
	                    <ul class="slides">
	                        <?php foreach ($images as $image):
	                            if(!is_array($image)){
	                                $img = wp_get_attachment_image($image, "thumbnailGal");
	                            }else{
	                                $img = '<img src="'.$image['sizes']['thumbnailGal'].'" alt="'.$image['alt'].'" class="img-responsive" />';
	                            }
	                            ?>
	                            <li>
	                            	<div class="holder-thumb">
	                            		<?php echo $img; ?>
	                            		<div class="sprites icon-lupa"></div>
	                            	</div>
	                            </li>
	                        <?php endforeach; ?>
	                    </ul>
                   	</div>
                </div>
                <?php }} ?>
                
                <?php
                // Vídeos
                $videosS = get_field('videos');
                if(!is_array($videosS)){
                    $videosS = array();
                }
                $videos = array();
                foreach($videosS as $video){
                    if($video['url'] == ""){
                        continue;
                    }
                    $videos[] = $video;
                }
                if(count($videos) > 0){
                    ?>
                    <div class="rowVideos row">
                        <div class="col-xs-12">
                            <h2 class="tilt-internas detal-title single-plantel-secundario">Video</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        foreach($videos as $video){ ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 single-video">
                                <?php
                                $video = $video['url'];
                                $parts = parse_url($video);
                                $query = array();
                                parse_str($parts['query'], $query);
                                $videoOk = $query['v'];
                                ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?php echo $videoOk; ?>?rel=0" width="350" height="248" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="cf"></div>
                    </div>
                <?php } ?>
            </div>

            <!-- Coluna Lateral -->
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 coluna-direita">


               <div class="row">
               		<div class="col-xs-12">
               			<div class="single-info">
               				Registro: <?php echo $abccmm ?>
               			</div>
               			<div class="cf"></div>
               		</div>
               			<div class="col-xs-6">
               				<div class="single-info single-info-sec">
	               				<p><strong>Data de Nascimento</strong></p>
	               				<p><?php echo $nascimento; ?></p>
	               				<div class="cf"></div>
	               			</div>
               			</div>
               			<div class="col-xs-6">
               				<div class="single-info single-info-right single-info-sec">
	               				<p><strong>Pelagem</strong></p>
	               				<p><?php echo $pelugem; ?></p>
	               				<div class="cf"></div>
               				</div>
               			</div>
	                    <div class="fd-paiMae cavalos-pais hidden-xs">
	                       <div class="col-xs-6">
	                            <p class="tilt">Pai</p>
	                            <img src="<?php echo $thumbPaiOk; ?>" alt="<?php echo $nomePai; ?>" class="img-responsive">
	                            <p class="nome-cavalo"><?php echo $nomePai; ?></p>
	                       </div>
	                       <div class="col-xs-6">
	                            <p class="tilt">Mãe</p>
	                            <img src="<?php echo $thumbMaeOk; ?>" alt="<?php echo $nomeMae; ?>" class="img-responsive">
	                            <p class="nome-cavalo"><?php echo $nomeMae; ?></p>
	                       </div>
	                       <div class="cf"></div>
	                    </div>
	                    <div class="col-xs-12">
			                <div class="row container-pais-mobile visible-xs">
			                    <div class="fd-paiMae cavalos-pais">
			                        <div class="col-xs-6">
			                            <p class="tilt">Pai</p>
			                            <img src="<?php echo $thumbPaiOk; ?>" alt="<?php echo $nomePai; ?>" class="img-responsive">
			                            <p><?php echo $nomePai; ?></p>
			                        </div>
			                        <div class="col-xs-6">
			                            <p class="tilt">Mãe</p>
			                            <img src="<?php echo $thumbMaeOk; ?>" alt="<?php echo $nomeMae; ?>" class="img-responsive">
			                            <p><?php echo $nomeMae; ?></p>
			                        </div>
			                        <div class="cf"></div>
			                    </div>
			                </div>
	                    	<div class="container-descricao">
		                    	<p><strong>Descrição</strong></p>
		                    	<div class="txt-descricao">
		                    		<?php echo $sobre; ?>
		                    	</div>
		                    </div>
	                    </div>
	                </div>
            </div>
            <!-- Coluna Lateral -->
        </div>

        <div class="row">
                	<div class="col-xs-12">
                		<div class="genealogia">
	                		<h2 class="tilt-internas detal-title single-plantel-secundario">Genealogia<a name="pedigree2"></a></h2>
			                <div style="width: 100%; margin: 0 0 30px 0; overflow: hidden; position: relative">
			                    <?php echo do_shortcode('[pedigree no_image="'.get_template_directory_uri()."/img/no_image_quadrado.jpg".'"]'); ?>
			                </div>
			            </div>
                	</div>
                </div>

                <?php
                    // Awards
                    $awards = array();
                    while ( have_rows('content_awards') ) : the_row();
                        $item = array();
                        $item['event'] = get_sub_field("event_awards");
                        if(!$item['event'] or !get_sub_field('view_site')){
                            continue;
                        }
                        $item['city'] = get_sub_field("city_awards");
                        $item['date'] = get_sub_field("period_awards");
                        $item['award'] = get_sub_field("award");
                        $item['number'] = get_sub_field("number_of_partipating_animals_award");
                        $item['position'] = get_sub_field("position_awards");
                        $item['category'] = get_sub_field("category_awards");
                        $awards[] = $item;
                    endwhile;

                    if(count($awards)){

                    ?>
                    <div class="row">
                        <div class="content-awards col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <h2 class="tilt-internas detal-title single-plantel-secundario">Premiação</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Evento</th>
                                        <th>Cidade</th>
                                        <th>Período</th>
                                        <th>Premiação</th>
                                    </tr>

                                    <?php
                                        $a = 1;
                                            foreach ( $awards as $item ){
                                            $event = $item['event'];
                                            $city = $item['city'];
                                            $date = $item['date'];
                                            $award = $item['award'];
                                            $number = $item['number'];
                                    ?>

                                    <tr>
                                        <td><?php echo $event; ?></td>
                                        <td><?php echo $city; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $award; ?></td>
                                    </tr>

                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

    </div>
</section>
<?php get_footer(); ?>