<?php

add_action('init', 'create_posttype' );
function create_posttype() {
    register_post_type('equipe',
        array(
            'labels' => array(
                'name' => __( 'Equipe', 'hmn' ),
                'singular_name' => __( 'Equipe', 'hmn' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'equipe'),
            'supports' => array(
                'title',
                'thumbnail'
            )
        )
    );

    register_post_type('leiloes',
        array(
            'labels' => array(
                'name' => __( 'Leilões', 'hmn' ),
                'singular_name' => __( 'Leilões', 'hmn' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'leiloes'),
            'supports' => array(
                'title',
                'thumbnail'
            )
        )
    );

    register_post_type('galeria',
        array(
            'labels' => array(
                'name' => __( 'Galerias', 'hmn' ),
                'singular_name' => __( 'Galerias', 'hmn' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'galerias'),
            'supports' => array(
                'title',
            )
        )
    );

    register_taxonomy(
        'categoria-galeria',
        'galeria',
        array(
            'label' => __( 'Categoria de galeria', 'hmn' ),
            'rewrite' => array( 'slug' => 'categoria-galeria' ),
            'hierarchical' => true
        )
    );
}

?>