<?php
add_action( 'plugins_loaded', 'animalsfastdezineplugin_register_acf_selo' );
function animalsfastdezineplugin_register_acf_selo(){
     
    if( function_exists('register_field_group') ):
    
        register_field_group(array (
            'key' => 'group_55afdf1b4bd56',
            'title' => __('Ribbons Fields', 'animalsfastdezineplugin'),
            'fields' => array (
                array (
                    'key' => 'field_55afdf2251c18',
                    'label' => __('Image (Left)', 'animalsfastdezineplugin'),
                    'name' => 'image_pt-br',
                    'prefix' => '',
                    'type' => 'image',
                    'instructions' => '96 x 96',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                    'library' => 'uploadedTo',
                ),
                array (
                    'key' => 'field_faafdf2251c18',
                    'label' => __('Image (Right)', 'animalsfastdezineplugin'),
                    'name' => 'image_right_pt-br',
                    'prefix' => '',
                    'type' => 'image',
                    'instructions' => '96 x 96',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                    'library' => 'uploadedTo',
                ),                
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'selo',
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