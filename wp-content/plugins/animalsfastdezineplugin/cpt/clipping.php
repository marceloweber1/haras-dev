<?php

add_action( 'init', 'animalsfastdezineplugin_init_cpt_clipping' );
function animalsfastdezineplugin_init_cpt_clipping() {

    $labels = array(
        'name' => __( 'News', 'animalsfastdezineplugin' ),
        'singular_name' => __( 'News',  'animalsfastdezineplugin' ),
        'all_items' => __( 'View news', 'animalsfastdezineplugin' )
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
    register_post_type( 'clipping', $args);
    
    $labels = array(
        'name'              => __( 'News categories', 'animalsfastdezineplugin' ),
        'singular_name'     => __( 'News category ', 'animalsfastdezineplugin' ),
        'all_items'     => __( 'View news categories', 'animalsfastdezineplugin' ),
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
    register_taxonomy( 'clipping_categoria', array( 'clipping' ), $args );

}


add_filter('wp_insert_post_data', 'animalsfastdezineplugin_change_post_clipping');
function animalsfastdezineplugin_change_post_clipping($data){
    if(('clippings' == $data['post_type']) and is_array($_POST['acf'])){
        $data['post_content'] = $_POST['acf']['field_87a956e79AA02'];
    }
    return $data;
}

function animalsfastdezineplugin_clipping_configure_thumbnail( $post_id ) {
    if(get_post_type($post_id) == "clipping"){
        $gallery = $_POST['acf']['field_19bb6ef0b7493'];
        if(count($gallery) > 0){
            set_post_thumbnail( $post_id, $gallery[0] );
        }else{
			delete_post_thumbnail( $post_id );
		}
    }
}
add_action( 'save_post', 'animalsfastdezineplugin_clipping_configure_thumbnail' );

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_status_clipping');
}

function animalsfastdezineplugin_custom_post_status_clipping(){
    global $post;
    if($post->post_type == 'clipping'){
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($){
                jQuery('#wpbody-content h2').first().html('<?php echo __('News Title', 'animalsfastdezineplugin') ?>');
            });
        </script>
    <?php
    }
}