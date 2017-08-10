<?php

include(__DIR__."/functions.php");

include(__DIR__."/admin/config.php");

function pedigree_load_default_scripts() {
    if((is_singular( 'cavalo' )) and !defined('DISABLEPEDIGREE')){

        wp_enqueue_script('fancybox-js', "https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js", array('jquery'), '1.0.0' );
        wp_enqueue_script('dotdotdot-js', plugins_url( 'animalsfastdezineplugin/pedigree/assets/js/jquery.dotdotdot.js', ANIMALSFASTDEZINEPLUGIN ), array('jquery'), '1.0.0' );
        wp_enqueue_script('swipe-js', plugins_url( 'animalsfastdezineplugin/pedigree/assets/js/jquery.swipe.js', ANIMALSFASTDEZINEPLUGIN ), array('jquery'), '1.0.0' );
        wp_enqueue_script('pedigree-js', plugins_url( 'animalsfastdezineplugin/pedigree/assets/js/scripts.js', ANIMALSFASTDEZINEPLUGIN ), array('jquery'), '1.0.0' );

        wp_enqueue_style( 'fancybox-css', "https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css", array(), '' );
        wp_enqueue_style( 'pedigree-css', plugins_url( 'animalsfastdezineplugin/pedigree/assets/css/estilo.css', ANIMALSFASTDEZINEPLUGIN ), array(), '' );

    }
}
add_action('wp_enqueue_scripts', 'pedigree_load_default_scripts');

function pedigree_shortcode( $atts ) {

    global $pedigreeNoImage;
    
    $atts = shortcode_atts( array(
        'no_image' => plugins_url( 'pedigree/assets/images/no-photo.jpg', ANIMALSFASTDEZINEPLUGIN )
    ), $atts, 'pedigree' );
    
    $pedigreeNoImage = $atts['no_image'];
    
    ob_start();    
    ?>

    <div class="container_pedigree">

        <div class="linha linha-0">
            <?php pedigreePrintCavalo(0, get_post(), null); ?>
        </div>

    </div>

    <div class="bolinhas-container">

    </div>

    <?php

    $html = ob_get_clean();
    
    return $html;
}

add_shortcode( 'pedigree', 'pedigree_shortcode' );