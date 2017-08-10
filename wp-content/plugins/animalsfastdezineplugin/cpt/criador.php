<?php

add_action( 'init', 'animalsfastdezineplugin_init_cpt_criador' );
function animalsfastdezineplugin_init_cpt_criador()
{

    $labels = array(
        'name' => __('Breeders/Owners', 'animalsfastdezineplugin'),
        'singular_name' => __('Breeder/Owner', 'animalsfastdezineplugin'),
        'all_items' => __('View breeders/owners', 'animalsfastdezineplugin'),
        'menu_name' => __(' Breeders/Owners ', 'animalsfastdezineplugin'),
    );
    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'show_in_menu' => true,
        'supports' => false
    );
    register_post_type('criador', $args);

}

add_filter('wp_insert_post_data', 'animalsfastdezineplugin_change_title_criador');
function animalsfastdezineplugin_change_title_criador($data){    
    if('criadores' == $data['post_type'] and is_array($_POST['acf'])){
        $data['post_title'] = reset($_POST['acf']);
    }
    return $data;
}

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_criador');
}

function animalsfastdezineplugin_custom_post_criador(){
    global $post;
    if($post->post_type == 'criador'){
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($){
                jQuery('#wpbody-content h2').first().html('<?php echo __('Breeder/Owner ', 'animalsfastdezineplugin') ?>');
            });
        </script>
    <?php
    }
}