<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 11/08/2015
 * Time: 10:14
 */

add_action( 'init', 'init_cpt_parceiros' );
function init_cpt_parceiros(){
    $labels = array(
        'name' => __('Partners', 'animalsfastdezineplugin'),
        'singular_name' => __('Partner', 'animalsfastdezineplugin'),
        'all_items' => __('View partner', 'animalsfastdezineplugin')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'show_in_menu' => true,
        'supports' => array(
            'title',
            'thumbnail',
        )
    );
    register_post_type('parceiro', $args);
}

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_parceiro');
}

function animalsfastdezineplugin_custom_post_partners(){
    global $post;
    if($post->post_type == 'parceiro'){
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($){
                jQuery('#wpbody-content h2').first().html('<?php echo __('Partner', 'animalsfastdezineplugin') ?>');
            });
        </script>
    <?php
    }
}