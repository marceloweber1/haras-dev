<?php

add_action( 'plugins_loaded', 'animalsfastdezineplugin_register_acf_evento' );
function animalsfastdezineplugin_register_acf_events(){

    if (function_exists('register_field_group')):

        register_field_group(array(
            'key' => 'group_55bb6ee558802',
            'title' => __('Item Fields', 'animalsfastdezineplugin'),
            'fields' => array(
                array(
                    'key' => 'field_0fa95fe7f022f',
                    'label' => __('CONTENT', 'animalsfastdezineplugin'),
                    'name' => '',
                    'prefix' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                ),
                array(
                    'key' => 'field_87a956e79AA02',
                    'label' => '',
                    'name' => 'texto',
                    'prefix' => '',
                    'type' => 'textarea',
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
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => 'wpautop',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
                array(
                    'key' => 'field_02a956e79022d',
                    'label' => __('MEDIA', 'animalsfastdezineplugin'),
                    'name' => '',
                    'prefix' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                ),
                array(
                    'key' => 'field_19bb6ef0b7493',
                    'label' => __('Gallery', 'animalsfastdezineplugin'),
                    'name' => 'gallery',
                    'prefix' => '',
                    'type' => 'gallery',
                    'instructions' => '',//__('Limit of 4 images', 'animalsfastdezineplugin'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'min' => '',
                    'max' => '4',
                    'preview_size' => 'thumbnail',
                    'library' => 'uploadedTo',
                ),
                array(
                    'key' => 'field_66a956e791101',
                    'label' => __('Video Url', 'animalsfastdezineplugin'),
                    'name' => 'video',
                    'prefix' => '',
                    'type' => 'url',
                    'instructions' =>  __('Only Youtube video Url.', 'animalsfastdezineplugin'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'evento',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
        ));

    endif;
}