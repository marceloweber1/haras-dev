<?php
/*
Plugin Name: Animals Plugin
Plugin URI:  http://www.fastdezine.com
Description: Plugin com todas as funcionalidades desenvolvidas para os temas de animais da fastdezine.com
Version:     1.0
Author:      Michael Fagundes Marques
Author URI:  http://www.fastdezine.com
Domain Path: /languages
Text Domain: animalsfastdezineplugin
*/

define("ANIMALSFASTDEZINEPLUGIN", "animalsfastdezineplugin");

add_action( 'plugins_loaded', 'animalsfastdezineplugin_load_textdomain' );
function animalsfastdezineplugin_load_textdomain() {
    load_plugin_textdomain( 'animalsfastdezineplugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

include(__DIR__."/pedigree/pedigree.php");

include(__DIR__."/inc/aq_resizer.php");

include(__DIR__."/configs.php");
include(__DIR__."/cpt.php");
include(__DIR__."/acf.php");

include(__DIR__."/shortcodes/mini-post-grid.php");

function animalsfastdezineplugin_theme_dashboard_redirect() {
    global $parent_file;
    if ( 'index.php' == $parent_file && get_current_user_id() != 1 ) {
        if ( headers_sent() ) {
            echo '<meta http-equiv="refresh" content="0;url=' . admin_url( 'edit.php?post_type=cavalo' ) . '">';
            echo '<script type="text/javascript">document.location.href="' . admin_url( 'edit.php?post_type=cavalo' ) . '"</script>';
            exit;
        } else {
            if ( wp_redirect( admin_url( 'edit.php?post_type=cavalo' ) ) ) {
                exit();
            }
        }
    }
}
add_action( 'admin_head', 'animalsfastdezineplugin_theme_dashboard_redirect', 0 );


add_action('admin_menu','animalsfastdezineplugin_hideupdatenag');
function animalsfastdezineplugin_hideupdatenag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}

if(!function_exists("getIdBySlug")) {
    function getIdBySlug($page_slug){
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
}