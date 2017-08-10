<?php

add_action( 'plugins_loaded', 'register_acf_galeria_fotos' );
function register_acf_galeria_fotos()
{

    if (function_exists('register_field_group')):

        register_field_group(array(
            'key' => 'group_55c2d515e0c21',
            'title' => __('Photo Gallery Fields', 'animalsfastdezineplugin'),
            'fields' => array(
                array(
                    'key' => 'field_55ca94f2d1ded',
                    'label' => __('Gallery Name', 'animalsfastdezineplugin'),
                    'name' => 'nome_galeria',
                    'prefix' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
                array(
                    'key' => 'field_55c2d53048ffa',
                    'label' => __('Images', 'animalsfastdezineplugin'),
                    'name' => 'imagens',
                    'prefix' => '',
                    'type' => 'gallery',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'min' => '',
                    'max' => '',
                    'preview_size' => 'thumbnail',
                    'library' => 'uploadedTo',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-galeria-fotos.php',
                    ),
                ),
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-galeria-fotos.php',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                1 => 'the_content',
                2 => 'excerpt',
                3 => 'custom_fields',
                4 => 'discussion',
                5 => 'comments',
                6 => 'revisions',
                7 => 'slug',
                8 => 'author',
                9 => 'format',
                10 => 'page_attributes',
                11 => 'featured_image',
                12 => 'categories',
                13 => 'tags',
                14 => 'send-trackbacks',
            ),
        ));

    endif;
}