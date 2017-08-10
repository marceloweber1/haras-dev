<?php
/*
  Plugin Name: Pedigree Plugin 2
  Plugin URI:
  Description:
  Author: Fastdezine Inc.
  Version: 1.0
  Author URI: http://fastdezine.com/
 */

Class Pedigree {
    
    public function savePedigree() {
        if (isset($_POST['pedigree']) && isset($_POST['post_ID'])) {
            foreach ($_POST['pedigree'] as $animalID => $motherAndFather) {
                foreach ($motherAndFather as $motherOrFather_key => $motherOrFather_id) {
                    update_post_meta($animalID, $motherOrFather_key, trim($motherOrFather_id));
                }
            }
        }
    }
    
}

function pedigree_menu() {
    $pedigree = new Pedigree();
    $pedigree->savePedigree();
    add_meta_box('pedigree_horses_box', 'Pedigree', 'pedigree_options', 'cavalo');
}
function pedigree_options() {
    require(__DIR__."/page.php");
}
add_action( 'admin_menu', 'pedigree_menu' );