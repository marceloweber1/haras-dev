<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 07/08/2015
 * Time: 15:21
 */

function pedigreePrintFantasma($linha){
    global $pedigreeNoImage;
    $thumb = $pedigreeNoImage;
    ?>
    <div class="cavalo fantasma">
        <div class="imagem no-photo" style="background-image: url('<?php echo $thumb ?>');">
        </div>
        <div class="dados">
        </div>
    </div>
    <?php
    if($linha + 1 > 4){
        return;
    }
    ?>
    <div class="seta fantasma-linha">
        <div class="seta-1"></div>
        <div class="seta-2"></div>
        <div class="seta-3"></div>
        <div class="seta-4"></div>
    </div>
    <div class="linha linha-<?php echo $linha+1; ?>">
        <?php pedigreePrintFantasma($linha+1); ?>
    </div>
    <div class="linha linha-<?php echo $linha+1; ?>">
        <?php pedigreePrintFantasma($linha+1); ?>
    </div>
<?php
}

function pedigreePrintCavalo($linha, $cavalo, $SexPadrao){
    
    global $pedigreeNoImage;

    if($linha > 4 or !$cavalo){
        return;
    }

    $ID = $cavalo->ID;

    $data = get_field('date_birth', $cavalo->ID);
    $data = explode("/", $data);

    $sexo = get_field('gender', $cavalo->ID);

    switch($sexo){
        case "Potra":
        case "Égua":
            $sexo = "F"; break;
        case "Potro":
        case "Garanhão":
            $sexo = "M"; break;
        default: $sexo = $SexPadrao; break;
    }

    if(count($data) == 3){
        $ano = $data[2];
    }else{
        $ano = "-";
    }

    $pai = get_post_meta($cavalo->ID, 'father', true);
    $mae = get_post_meta($cavalo->ID, 'mother', true);

    $aboutHorse = getHorseDescription($cavalo->ID);

    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($cavalo->ID), 'tamanho' );
    $thumb = $thumb['0'];

    $semFoto = false;

    $classFoto = "";

    if(!$thumb){
        $semFoto = true;
        $thumb = $pedigreeNoImage;
        $noFotoGrande = $pedigreeNoImage;
        $classFoto = "no-photo";
    }

    ?>
    <div class="cavalo <?php echo $linha==0?'cavalo-principal':'' ?> <?php if(!$pai and !$mae){ ?>sem-pai<?php } ?>">
        <div class="imagem  <?php if($classFoto){echo $classFoto; } ?>" style="background-image: url('<?php echo $thumb ?>');">
        </div>
        <div class="dados">
            <p class="ano"><?php echo $ano ?></p>
            <p class="nome"><?php echo $cavalo->post_title; ?></p>
            <ul class="icones">
                <?php if(!$semFoto){ ?><li class="icon-thumb"><a href="#cavalo-<?php echo $cavalo->ID; ?>">I</a></li><?php } ?>
                <?php if($aboutHorse){ ?><li class="icon-text"><a href="#cavalo-<?php echo $cavalo->ID; ?>">T</a></li><?php } ?>
                <?php if($pai || $mae){ ?><li class="icon-arvore"><a href="#cavalo-<?php echo $cavalo->ID; ?>"></a></li><?php } ?>
            </ul>
            <span class="sexo sexo-<?php echo $sexo ?>"><?php echo $sexo ?></span>
        </div>
        <div class="box" id="cavalo-<?php echo $cavalo->ID; ?>">
            <h3 style="margin-bottom: 20px;"><?php echo $cavalo->post_title; ?></h3>
            <?php if(!$semFoto){ ?>
                <div class="imagem"><img src="<?php echo $thumb; ?>" /></div>
            <?php }else{ ?>
                <div class="imagem"><img src="<?php echo $noFotoGrande; ?>" /></div>
            <?php } ?>
            <?php if($aboutHorse){ ?><div class="texto" style="margin: 0 30px;"><?php echo $aboutHorse; ?></div><?php } ?>
            <?php if($pai || $mae){ ?>
                <div style="text-align: center; margin-top: 30px;">
                    <a class="btn-destaques" style="display: inline-block; position: relative; left: 0px; width: 150px; top: 0px;" title="<?php _e("See genealogy", 'marchador2ezplugin'); ?>" target="_blank" href="<?php echo get_the_permalink($cavalo->ID); ?>#pedigree">
                        <span><?php _e("See genealogy", 'animalsfastdezineplugin'); ?></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    if($linha + 1 > 3){
        return;
    }
    ?>
    <div class="seta <?php if(!$pai and !$mae){ ?>fantasma-linha<?php } ?>">
        <div class="seta-1"></div>
        <div class="seta-2"></div>
        <div class="seta-3"></div>
        <div class="seta-4"></div>
    </div>
    <?php
    if($pai){
        $pai = get_post($pai);
        ?>
        <div class="linha linha-<?php echo $linha+1; ?>">
            <?php pedigreePrintCavalo($linha+1, $pai, 'M'); ?>
        </div>
    <?php
    }else{
        ?>
        <div class="linha linha-<?php echo $linha+1; ?>">
            <?php pedigreePrintFantasma($linha+1); ?>
        </div>
    <?php
    }
    if($mae){
        $mae = get_post($mae);?>
        <div class="linha linha-<?php echo $linha+1; ?>">
            <?php pedigreePrintCavalo($linha+1, $mae, 'F'); ?>
        </div>
    <?php
    }else{
        ?>
        <div class="linha linha-<?php echo $linha+1; ?>">
            <?php pedigreePrintFantasma($linha+1); ?>
        </div>
    <?php
    }

}