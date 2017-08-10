<?php
/*
  Plugin Name: CSV/XLS Import ABCCMM
  Plugin URI:
  Description:
  Author: Fastdezine Inc.
  Version: 1.2
  Author URI: http://fastdezine.com/
 */

add_action( 'admin_menu', 'CsvImportAbccmm' );
function CsvImportAbccmm(){
	add_menu_page( __('ABCCMM Data Sheet Importation', 'import_abccmm'), __('ABCCMM Data Sheet Importation', 'import_abccmm'), 'manage_options', 'csv-import-abccmm', 'CsvImportAbccmm_page' ); 
}
function CsvImportAbccmm_page(){
	require __DIR__ . "/page.php";
}

add_action( 'plugins_loaded', 'import_abccmm_load_textdomain' );
function import_abccmm_load_textdomain() {
    load_plugin_textdomain( 'import_abccmm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}