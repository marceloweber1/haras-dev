<?php

function animalsfastdezineplugin_remove_admin_bar_links() {
    global $wp_admin_bar;
    if(get_current_user_id() != 1){
        add_filter('screen_options_show_screen', '__return_false');
        $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
        $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
        $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
        $wp_admin_bar->remove_menu('updates');          // Remove the updates link
        $wp_admin_bar->remove_menu('comments');         // Remove the comments link
        $wp_admin_bar->remove_menu('new-content');      // Remove the content link
        $wp_admin_bar->remove_menu('my-sites-super-admin');       // Remove the user details tab
        $wp_admin_bar->remove_menu('my-sites');       // Remove the user details tab
        $wp_admin_bar->remove_menu('my-sites-list');       // Remove the user details tab
        $wp_admin_bar->remove_menu('view');       // Remove the user details tab
    }
}
add_action( 'wp_before_admin_bar_render', 'animalsfastdezineplugin_remove_admin_bar_links' );

add_action('wp_head', 'animalsfastdezineplugin_disable_search_adminbar');
function animalsfastdezineplugin_disable_search_adminbar() {
    echo "<style> #wpadminbar #wp-admin-bar-search { display: none; } </style>";
}

add_action('admin_head', 'animalsfastdezineplugin_hide_things' );
function animalsfastdezineplugin_hide_things(){
    global $wp_meta_boxes, $current_screen, $post;	
	?>	
	<style type="text/css">	
		#toplevel_page_sca-wordpress{
			display: none;
		}	
	</style>	
	<?php	
	
	remove_meta_box('cavalo_categoriadiv', 'cavalo', 'side');
	
    if(get_current_user_id() != 1) {
        remove_meta_box('icl_div_config', $post->posttype, 'normal');
        remove_meta_box('pageparentdiv', 'page', 'side');
        remove_meta_box('postimagediv', 'page', 'side');
        remove_meta_box('cmsnavdiv', 'page', 'normal');    
        ?>
        <style type="text/css">
            .nav-menus-php #nav-menus-frame, .nav-menus-php #wpbody-content #menu-settings-column{
                margin-left: 0;
            }
            #menu-dashboard, #pageparentdiv, .post-type-page #postimagediv, #cmsnavdiv, #cavalo_categoriadiv,
            .attachment-details [data-setting="title"],
            .attachment-details [data-setting="caption"],
            .attachment-details [data-setting="alt"],
            .attachment-details [data-setting="description"],
            .media-modal .compat-item,
            div.attachment-display-settings,
            .acf-field-gallery .bulk-actions,
            .acf-field-gallery .form-table tbody tr:nth-child(3),
            .acf-field-gallery .form-table tbody tr:nth-child(4),
            .acf-field-gallery .form-table tbody tr:nth-child(5),
            #wp-admin-bar-WPML_ALS, .post-type-page #edit-slug-box, .post-type-page .add-new-h2,
            .post-type-our_horses .inline-edit-date, .post-type-our_horses .inline-edit-group, .post-type-our_horses .inline-edit-col label:nth-child(4),
            .post-type-nelores .inline-edit-date, .post-type-nelores .inline-edit-group, .post-type-nelores .inline-edit-col label:nth-child(4),
            .post-type-girs .inline-edit-date, .post-type-girs .inline-edit-group, .post-type-girs .inline-edit-col label:nth-child(4),
            .post-type-events .inline-edit-date, .post-type-events .inline-edit-group, .post-type-events .inline-edit-col label:nth-child(4),
            .post-type-clippings .inline-edit-date, .post-type-clippings .inline-edit-group, .post-type-clippings .inline-edit-col label:nth-child(4),
            .post-type-partners .inline-edit-date, .post-type-partners .inline-edit-group, .post-type-partners .inline-edit-col label:nth-child(4),
            .post-type-partners #edit-slug-box, .post-type-owners_breeders .row-actions .inline,
            .post-type-events .edit-slug-box, .post-type-events .edit-slug-box,
            .nav-menus-php .menu-settings, .nav-menus-php .delete-action,
            .nav-menus-php .menu-name-label, .nav-menus-php .add-new-menu-action, .nav-menus-php .manage-menus, .nav-menus-php #nav-menu-header,
            .post-type-events #events_regions-adder, .post-type-clippings #clipping_category-adder,
            #icl_div_config, .profile-php #your-profile, #menu-users,
            .nav-menus-php .add-partners, .nav-menus-php .add-category, .nav-menus-php .add-events_regions, .nav-menus-php .item-delete, .nav-menus-php .meta-sep,
            .nav-menus-php .nav-tab-wrapper .nav-tab:nth-child(2), .nav-menus-php #side-sortables,
            body.post-type-page #delete-action, body.post-type-page #icl_minor_change_box, body.post-type-page input[name="post_title"],
            body.post-type-page #wpbody-content .wrap > h1 > a, #post-61{
                display: none;
            }
            <?php if($current_screen->id == 'edit-page'){ ?>
            .add-new-h2, .type-page .trash, .type-page .inline, .post-type-page .bulkactions {
                display: none;
            }
            <?php } ?>
        </style>
    <?php
    }
}

foreach ( array( 'post', 'post-new' ) as $hook ){
    add_action( "admin_footer-{$hook}.php", 'animalsfastdezineplugin_customize_form_page', 99);
}

function animalsfastdezineplugin_customize_form_page(){
    global $post;
    if(get_current_user_id() != 1){
         ?>
        <script type="text/javascript">

            jQuery('#wpbody-content .wrap').css('visibility', 'hidden');

            jQuery( document ).ready( function($){
                jQuery('.below-h2').each(function(){
                    var $this = $(this);
                    $this.find('a').attr('target', '_blank');
                    var $h2 = $this.prev();
                    $h2.before($this);
                });

                jQuery('.postbox .handlediv').remove();
                jQuery('.postbox h3.hndle').on('click', function(e){
                    var $this = jQuery(this);
                    setTimeout(function(){
                        $this.parent().removeClass('closed');
                    }, 50);
                });
                jQuery('.postbox').removeClass('closed');

                jQuery('#icl_div #icl_translate_options').nextAll().hide();
                jQuery('.edit-tags-php.taxonomy-events_regions #parent, .edit-tags-php.taxonomy-clipping_category #parent').each(function(){
                    var $this = jQuery(this);
                    $this.parent().hide();
                });
                jQuery('#submitdiv #visibility, #submitdiv .misc-pub-curtime, #submitdiv #minor-publishing-actions').hide();

                var postStatus = {};
                var selected = "";
                var possuiPublish = false;
                var isPai = false;

                var removeStatus = ['pending'];
                
                if(jQuery('body.post-type-page').length > 0){
                    removeStatus.push('draft');                    
                    var tituloPagina = $('input[name="post_title"]').val();
                    $('.wrap > h2').first().append(tituloPagina);
                }

                jQuery('#submitdiv #post_status option').each(function(){
                    var text = $(this).html();
                    var val = $(this).attr('value');
                    postStatus[val] = text;
                    if($(this).prop('selected')){
                        selected = val;
                    }
                    if(val == 'publish'){
                        possuiPublish = true;
                    }
                });
                
                var $status = $('.misc-pub-post-status').empty().html('<label for="post_status">Status:</label><br/><br/>');
                for(var val in postStatus){
                    if(removeStatus.indexOf(val) > -1){ continue; }
                    $status.append('<div><input type="radio" '+(val==selected?'checked="checked"':'')+' name="post_status" value="'+val+'" /> '+postStatus[val]+' </div>');
                }
                
                if(selected == 'parents'){
                    isPai = true;
                }

                if(!possuiPublish){
                    $status.append('<div><input type="radio" name="post_status" value="publish" /> <?php echo __('Published', 'animalsfastdezineplugin'); ?> </div>');
                }

                jQuery('#wpbody-content .wrap').css('visibility', 'visible');

            } );
        </script>
    <?php
    }
}

add_action( "admin_footer-profile.php", 'animalsfastdezineplugin_customize_profile_page', 99);
function animalsfastdezineplugin_customize_profile_page(){
    return;
    if(get_current_user_id() != 1){
        ?>
        <script type="text/javascript">

            jQuery( document ).ready( function($){
                
                jQuery('.profile-php #your-profile').each(function(){
                    var $this = $(this);

                    var $h3 = $this.find('> h3');
                    var $table = $this.find('> .form-table');

                    $h3.get(4).remove();
                    $table.get(4).remove();

                    $h3.get(0).remove();
                    $table.get(0).remove();
                    
                    $this.find('#nickname').parents('tr').hide();
                    $this.find('#display_name').parents('tr').hide();

                    $this.find('#url').parents('tr').hide();
                    $this.find('#aim').parents('tr').hide();
                    $this.find('#yim').parents('tr').hide();
                    $this.find('#jabber').parents('tr').hide();

                    $this.css('display', 'block');
                    
                    $this.find('a[name="wpml"]').nextAll().filter('h3, table').remove();

                })

            } );
        </script>
        <?php
    }
}