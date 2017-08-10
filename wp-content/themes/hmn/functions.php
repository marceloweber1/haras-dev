<?php

include ("inc/cpt.php");

function custom_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5');
    add_image_size('sedeHaras', 540, 540, true);
    add_image_size('mapaContato', 514, 288, true);
    add_image_size('MapaLocalizacaoFull', 1025, 574, true);
    add_image_size('galeriaEquipe', 340, 340, true);
    add_image_size('thumbNews', 255, 210, true);
    add_image_size('thumbGallery', 480, 360, true);
    add_image_size('fullPost', 445, 99999, false);
    add_image_size('bannerHome', 1920, 487, true);
    add_image_size('destaquePlantel', 540, 458, true);
    add_image_size('thumbHorses', 350, 233, true);
    add_image_size('thumbLeilao', 150, 108, true);
    add_image_size('PrincipalCavalo', 730, 631);
	add_image_size('PrincipalCavalo2', 730, 999999);
	add_image_size('thumbnailGal', 160, 106, true);
	add_image_size('iconRedes', 99999, 16, true);
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

function register_my_menus() {
    register_nav_menus(
        array(
            'menu-topo' => __( 'Menu topo do site', 'hmn'),
            'menu-categorias' => __( 'Menu de categorias', 'hmn'),
        )
    );
}

add_action( 'init', 'register_my_menus' );

/* Carregar CSS */
	function harasMoradaNovaCSS() {
		$caminho = get_template_directory_uri();
		wp_enqueue_style( 'css geral', $caminho . "/css/screen.css", null, null );
		wp_enqueue_style( 'css_custom', $caminho . "/css/custom.css", null, time() );
		wp_enqueue_style( 'tipografia', "https://fonts.googleapis.com/css?family=Merriweather:300,300italic,400,400italic,700,700italic,900,900italic", null, null );
	}
	add_action( 'wp_enqueue_scripts', 'harasMoradaNovaCSS' );

/* Carregar CSS */

/* Carregar js */
function harasMoradaNovaJS(){
	$caminho = get_template_directory_uri();

	wp_enqueue_script('flexslider', $caminho . '/js/jquery.flexslider-min.js', array('jquery'), null, true);
	wp_enqueue_script('owl.carousel', $caminho . '/js/owl.carousel.min.js', array('jquery'), null, true);
	wp_enqueue_script('fancybox', $caminho . '/js/jquery.fancybox.pack.js', array('jquery'), null, true);
	wp_enqueue_script('googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBizUgsytHY-hMmkgdPnzBB5r6N86qoPSs', array('jquery'), null, true);
	wp_enqueue_script('acfMaps', $caminho . '/js/mapa.js', array('jquery', 'googleMaps'), null, true);
	wp_enqueue_script('geral', $caminho . '/js/script.js', array('jquery', 'flexslider', 'owl.carousel' , 'fancybox'), null, true);
}
add_action('wp_enqueue_scripts', 'harasMoradaNovaJS');
/* Carregar js */

/* Listar páginas filho */
function wpb_list_child_pages() {
	global $post;
	if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
		$string = '<ul class="list-inline">' . $childpages . '</ul>';
	}
	return $string;
}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');


add_action( 'init', 'rewrites_init' );
function rewrites_init(){
	add_rewrite_rule(
		'vendas/?$',
		'index.php?post_type=cavalo&venda=1',
		'top' );
	add_rewrite_rule(
		'vendas/([^/]*)/?$',
		'index.php?cavalo_categoria=$matches[1]&venda=1',
		'top' );
}

add_filter( 'query_vars', 'hmn_query_vars' );
function hmn_query_vars( $query_vars ){
	$query_vars[] = 'venda';
	return $query_vars;
}

function hmn_vendas_query( $query ) {
	
	if ( 'cavalo' === $query->query_vars['post_type'] && $query->is_archive() && $query->query_vars['venda'] == 1 ) {
		$tax_query = array(
			"relation" => "AND",
			array(
				'taxonomy' => 'cavalo_categoria',
				'field'    => 'slug',
				'terms'    => 'a-venda',
			)
		);		
		$query->set('tax_query', $tax_query);
	}

	if ( isset($query->query_vars['cavalo_categoria']) && $query->is_tax() && $query->query_vars['venda'] == 1 ) {
		$tax_query = array(
			"relation" => "AND",
			array(
				'taxonomy' => 'cavalo_categoria',
				'field'    => 'slug',
				'terms'    => 'a-venda'
			),
			array(
				'taxonomy' => 'cavalo_categoria',
				'field'    => 'slug',
				'terms'    => $query->query_vars['cavalo_categoria']
			),
		);
		$query->set('tax_query', $tax_query);
	}
	
	if ( $query->is_tax('cavalo_categoria') ){		
		$query->set('orderby', array('menu_order' => 'DESC', 'title' => 'ASC'));	
	}
	
	return $query;
}

add_filter( "pre_get_posts", "hmn_vendas_query" );

function wpdocs_special_nav_class( $classes, $item ) {
	
	global $wp_query;	
	
	if ( $wp_query->query_vars['venda'] == 1 && 'Vendas' == $item->title ) {
		$classes[] = "current-menu-item";
	}

	if ( $wp_query->query_vars['venda'] == 1 && 'Plantel' == $item->title ) {
		if(($key = array_search('current-menu-item', $classes)) !== false) {
			unset($classes[$key]);
		}
	}
	
	return $classes;
}
add_filter( 'nav_menu_css_class' , 'wpdocs_special_nav_class' , 10, 2 );

add_action( 'admin_menu', 'admin_pages' );
function admin_pages(){
    add_menu_page( __('Ordem dos animais', 'hmn'), __('Ordem dos animais', 'hmn'), 'manage_options', 'horse-animal-order', 'HorseOrder_Page' );
    
}

function HorseOrder_Page(){
    require __DIR__ . "/plugin/order-cavalos.php";
}


?>