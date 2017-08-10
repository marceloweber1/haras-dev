<?php

add_action( 'init', 'animalsfastdezineplugin_init_cpt_seals' );
function animalsfastdezineplugin_init_cpt_seals() {

    $labels = array(
        'name' => __( 'Ribbons', 'animalsfastdezineplugin' ),
        'singular_name' => __( 'Ribbon',  'animalsfastdezineplugin' ),
        'all_items' => __( 'View itens', 'animalsfastdezineplugin' )
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
            'title'
        )
    );
    register_post_type( 'selo', $args);

}

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_status_selo');
}

function animalsfastdezineplugin_custom_post_status_selo(){
    global $post;
    if($post->post_type == 'selo'){
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($){
                jQuery('#wpbody-content h2').first().html('<?php echo __('Ribbon Name', 'animalsfastdezineplugin') ?>');                
            });
        </script>
    <?php
    }
}

function get_selo_lado($id = null){

    if(!$id){
        $id = get_the_ID();
    }

    $side = get_field('ribbon_side', $id);
    if(!$side){
        $side = "left";
    }
    
    return $side;
    
}

function get_selo_cavalo($id = null){

    $ribbon = get_field('show_ribbon', $id);
    
    if(!$ribbon){
        return;
    }
    
    $side = get_selo_lado($id);
        
    switch($side){
        case "left": return get_field('image_pt-br', $ribbon);
        case "right": return get_field('image_right_pt-br', $ribbon);
    }
        
}