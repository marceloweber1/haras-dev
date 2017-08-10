<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 11/08/2015
 * Time: 10:15
 */

add_action( 'plugins_loaded', 'animalsfastdezineplugin_register_acf_parceiro' );
function animalsfastdezineplugin_register_acf_parceiro(){

    if (function_exists('register_field_group')):

        register_field_group(array(
            'key' => 'group_55c9c4d10dc13',
            'title' => __('Dados Partners', 'animalsfastdezineplugin'),
            'fields' => array(
                array(
                    'key' => 'field_55c9c4e2d2a0e',
                    'label' => __('Link', 'animalsfastdezineplugin'),
                    'name' => 'link',
                    'prefix' => '',
                    'type' => 'url',
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
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'parceiro',
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