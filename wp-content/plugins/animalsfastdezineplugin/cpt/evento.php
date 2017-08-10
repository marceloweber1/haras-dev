<?php

add_action( 'init', 'animalsfastdezineplugin_init_cpt_evento' );
function animalsfastdezineplugin_init_cpt_evento() {

    $labels = array(
        'name' => __( 'Events', 'animalsfastdezineplugin' ),
        'singular_name' => __( 'Event',  'animalsfastdezineplugin' ),
        'all_items' => __( 'View events', 'animalsfastdezineplugin' )
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
    register_post_type( 'evento', $args);

    $labels = array(
        'name'              => __( 'Regions', 'animalsfastdezineplugin' ),
        'singular_name'     => __( 'Region', 'animalsfastdezineplugin' ),
        'all_items'     => __( 'View regions', 'animalsfastdezineplugin' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => true,
        'exclude_from_search' => false,
        'with_front'    => true
    );
    register_taxonomy( 'evento_regiao', array( 'evento' ), $args );

}

add_filter('wp_insert_post_data', 'animalsfastdezineplugin_change_post_evento');
function animalsfastdezineplugin_change_post_evento($data){
    if(('events' == $data['post_type']) and is_array($_POST['acf'])){
        $data['post_content'] = $_POST['acf']['field_87a956e79AA02'];
    }
    return $data;
}

function animalsfastdezineplugin_evento_configure_thumbnail( $post_id ) {
    if(get_post_type($post_id) == "evento"){
        $gallery = $_POST['acf']['field_19bb6ef0b7493'];
        if(count($gallery) > 0){
            set_post_thumbnail( $post_id, $gallery[0] );
        }else{
			delete_post_thumbnail( $post_id );
		}
    }
}
add_action( 'save_post', 'animalsfastdezineplugin_evento_configure_thumbnail' );

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_status_evento');
}

function animalsfastdezineplugin_custom_post_status_evento(){
    global $post;
    if($post->post_type == 'evento'){
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($){
                jQuery('#wpbody-content h2').first().html('<?php echo __('Event Name', 'animalsfastdezineplugin') ?>');                
            } );
        </script>
    <?php
    }
}