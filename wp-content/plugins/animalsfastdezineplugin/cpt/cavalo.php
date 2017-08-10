<?php

add_action( 'init', 'animalsfastdezineplugin_init_cpt_cavalo' );
function animalsfastdezineplugin_init_cpt_cavalo() {

    $labels = array(
        'name' => __( 'Horses', 'animalsfastdezineplugin' ),
        'singular_name' => __( 'Horse',  'animalsfastdezineplugin' ),
        'all_items' => __( 'View horses', 'animalsfastdezineplugin' )
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
    register_post_type( 'cavalo', $args);
    
    $labels = array(
        'name'              => __( 'Horses categories', 'animalsfastdezineplugin' ),
        'singular_name'     => __( 'Horses category ', 'animalsfastdezineplugin' ),
        'all_items'     => __( 'View categories', 'animalsfastdezineplugin' ),
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
    register_taxonomy( 'cavalo_categoria', array( 'cavalo' ), $args );

    //wp_insert_term('')
    
    register_post_status( 'parents', array(
        'label'                     => __( 'Parents', 'animalsfastdezineplugin' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( __('Parents <span class="count">(%s)</span>', 'animalsfastdezineplugin'), __('Parents <span class="count">(%s)</span>', 'animalsfastdezineplugin'), 'animalsfastdezineplugin' ),
    ) );
    
}

function animalsfastdezineplugin_pre_get_cavalo( $query ) {
    if ( 
    (
        (!$query->is_admin) 
        and ($query->query_vars['post_type'] == "cavalo") 
        and ($query->is_archive == 1 or $query->is_tax == 1 or $query->is_category == 1 or $query->is_search == 1 )
    )
    or
    (
        $query->is_admin and !isset($query->query_vars['post_status'])
    )
    ){
        $query->set( 'post_status', array('publish') );
    }
    
    if($query->query_vars['post_type'] == "cavalo" and $query->is_admin and $query->is_search){
        $query->set( 'post_status', array('publish', 'draft', 'parents') );
    }
        
}
add_action( 'pre_get_posts', 'animalsfastdezineplugin_pre_get_cavalo' );

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_custom_post_status_cavalo');
}
function animalsfastdezineplugin_custom_post_status_cavalo(){
    global $post;
    $complete = '';
    if($post->post_type == 'cavalo'){
        if($post->post_status == 'parents'){
            $complete = ' selected="selected"';
        }
		
		$macho = "[83,87,88,89,90,92,93,94,103,101,111,112,97,105,106,107]";
		$femea = "[84,85,86,98,99,100]";
		$castrado = "[83,87,88,89,90,92,93,94,85,84,103,101,111,112,97,105,106,107,98,100]";
		
        ?>
        <script type="text/javascript">                                    
            jQuery( document ).ready( function($){
                jQuery('#acf-group_55a956e775039 .hndle').remove();
                $( '#submitdiv #post_status' ).append( '<option value="parents" <?php echo $complete ?>><?php echo __('Parents', 'animalsfastdezineplugin') ?> </option>' );                
                jQuery('#wpbody-content h2').first().html('<?php echo __('Animal Name', 'animalsfastdezineplugin') ?>');
                <?php if(get_current_user_id() != 1){ ?>
                jQuery('#publish').attr('name', '');
                <?php } ?>
                
                $('#acf-field_55a956e7903cb').on('change', function(){
                   
                    var $categorias = $('.acf-field-55a956e79239d input');      
                    var $inputs = {};
                    $categorias.each(function(){                       
                        var $this = $(this);
                        $inputs[$this.val()] = $this;
                        $this.parents('li').show();                        
                    });
                    
                    var val = $(this).val();
                    
                    var ids = [];
                    
                    switch(val){
                        case 'Garanhão':
                        case 'Potro':                            
                            ids = <?php echo $macho; ?>;                            
                            break;
                        case 'Égua':
                        case 'Potra':
                            ids = <?php echo $femea; ?>;
                            break;
                        case 'Castrado':
                            ids = <?php echo $castrado; ?>;
                            break;
                    }
                    					
                    for(var i in ids){
                        if(!$inputs[ids[i]]){
                            continue;
                        }
                        $inputs[ids[i]].parents('li').hide();
                    }
                    
                }).trigger('change');
                
            } );
        </script>
    <?php
    }
}

function animalsfastdezineplugin_cavalo_configure_thumbnail( $post_id ) {
    if(get_post_type($post_id) == "cavalo"){
        $gallery = $_POST['acf']['field_55a956e791906'];
        if(count($gallery) > 0){
            set_post_thumbnail( $post_id, $gallery[0] );
        }else{
			delete_post_thumbnail( $post_id );
		}
    }    
}
add_action( 'save_post', 'animalsfastdezineplugin_cavalo_configure_thumbnail' );

function getCamposExibirCavalos($ID = null){
    
    if(!$ID){
        $ID = get_the_ID();
    }

    $campos = get_field('campo_exibir_cavalo', 'option');
    if(!is_array($campos)){
        $campos = array();
    }
        
    $return = array();
    
    foreach($campos as $campo){        
        switch($campo){
            case "gender":
                $field = get_field_object('gender');
                $return[__('Gender', 'animalsfastdezineplugin')] = $field['choices'][ get_field('gender', $ID) ];
                break;
            case "date_birth":                
                $return[__('Birth Date', 'animalsfastdezineplugin')] = get_field('date_birth', $ID);
                break;
            case "color":
                $field = get_field_object('color');
                $return[__('Color', 'animalsfastdezineplugin')] = $field['choices'][ get_field('color', $ID) ];
                break;
            case "height":
                $return[__('Height (hands)', 'animalsfastdezineplugin')] = get_field('height', $ID);
                break;
            case "associations":
                $vals = get_field('associations', $ID);
                foreach($vals as $val){
                    $association_name = $val['association_name'];
                    $association_value = $val['association_number'];                    
                    if($association_name == "-" or $association_value == ""){ continue; }
                    $return[sprintf(__('No. %s', 'animalsfastdezineplugin'), $association_name)] = $association_value;
                }
                break;
            case "chip":
                $val = get_field('chip', $ID);
                if($val == "NULL" or $val == "null"){continue;}
                $return[__('Chip No.', 'animalsfastdezineplugin')] = get_field('chip', $ID);
                break;
            case "dna_exam":
                $field = get_field_object('dna_exam');
                $return[__('DNA Exam', 'animalsfastdezineplugin')] = $field['choices'][ get_field('dna_exam', $ID) ];
                break;
            case "type_of_gait":
                $field = get_field_object('type_of_gait');
                $return[__('Type of Gait', 'animalsfastdezineplugin')] = $field['choices'][ get_field('type_of_gait', $ID) ];
                break;
            case "use":
                $field = get_field_object('use');
                $vals = get_field('use', $ID);
				if(!is_array($vals)){
					$vals = array();
				}
				$valExib = array(); 				
				if(count($vals) > 0){
					foreach($vals as $val){
						$valExib[] = $field['choices'][ $val ];
					}
				}				
                $return[__('Animal Use', 'animalsfastdezineplugin')] = implode(", ", $valExib);
                break;
            case "temperament":
                $field = get_field_object('temperament');
                $return[__('Temperament', 'animalsfastdezineplugin')] = $field['choices'][ get_field('temperament', $ID) ];
                break;
            case "breeder":
                $obj = get_post(get_field('breeder', $ID));
                $return[__('Breeder', 'animalsfastdezineplugin')] = $obj->post_title;
                break;
            case "owner":
                $obj = get_post(get_field('breeder', $ID));
                $return[__('Owner', 'animalsfastdezineplugin')] = $obj->post_title;
                break;
            case "description":
                $return['description'] = getHorseDescription($ID);
                break;
        }        
    }
    
    foreach($return as $campo => $val){
        if($val == "" or trim($val) == "-"){
            unset($return[$campo]);
        }
    }
    
    return $return;
    
}