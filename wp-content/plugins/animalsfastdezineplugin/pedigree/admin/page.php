<?php

global $post, $wpdb;

$pluginsUrl = plugins_url();

$levels = 4;

$sql = "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = '{$post->post_type}' AND post_status IN ('publish', 'draft', 'parents') ORDER BY post_title";
$portfolioItens = $wpdb->get_results($sql);

$itens = array();
foreach($portfolioItens as $item){
    $itens[] = array('id' => $item->ID, 'nome' => $item->post_title);
}

unset($portfolioItens);

?>

<style>
    .success,.error{font-weight: bold; font-size: 16px;}
    .success{ color: #3acf6a; }
    .error{ color: #c00; }
    .body{ font-family: Arial}
    .clear{ clear: both;}
    .hide{ display: none;}
    .float-right{ float:right;}
    .grid td{ padding: 5px;}
    
    #container_pedigree{
        height: 1210px;
        width: 100%;
        overflow: auto;
    }
    
    #container_pedigree .level{
        width: 145px;
        float: left;
    }

    .table_container_item{
        height: 1200px; 
    }

    .item_input{
        border: 1px solid #ccc;
    }
    
    .pedigree_item{
        text-align: center;
        padding: 8px 0;
    }
    .loading{
        display: none;
    }
    
</style>


<div class="plugin-pedigree">
    
<?php ob_start(); ?>
    <select class="pedigree_select" name="" style="visibility: hidden;">
        <option value=""><?php _e('Select', 'animalsfastdezineplugin'); ?></option>
    </select>
    <img class="loading" src="<?php echo $pluginsUrl ?>/animalsfastdezineplugin/assets/images/ajax-loader.gif" />
<?php $selectHtml = ob_get_clean() ?>

    <div id="container_pedigree">
        <table>
            <tr>
                <td>
                    <table class="table_container_item">
                        <tr>
                            <td class="td_item" >
                                <table class="item_input" style="height: 30px; padding: 10px">
                                    <tr>
                                        <td><strong><?php _e('This animal', 'animalsfastdezineplugin'); ?></strong></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="height: 100%; width: 100%;">
                                    <tr><td style="height: 25%; "></td></tr>
                                    <tr><td style="height: 25%; width: 10px; border-top: 1px dotted #999!important; border-left: 1px dotted #999!important; "></td></tr>
                                    <tr><td style="height: 25%; width: 10px; border-bottom: 1px dotted #999!important; border-left: 1px dotted #999!important;"></td></tr>
                                    <tr><td style="height: 25%;  "></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <?php for ($i = 1; $i <= $levels; $i++) : ?>
                    <td>
                        <table class="table_container_item">
                            <?php $numRows = pow(2, $i) ?>
                            <?php for ($ii = 1; $ii <= $numRows; $ii++) : ?>
                                <tr>
                                    <td class="td_item" >
                                        <table class="item_input">
                                            <tr>
                                                <td style="width:200px; background: <?php echo ($ii%2 == 0 ? '#ffb6c1' : '#00bfff') ?>">
                                                <div class="pedigree_item" id="pedigree_item_<?php echo $i ?>_<?php echo $ii ?>" pcol="<?php echo $i ?>" prow="<?php echo $ii ?>">
                                                    <?php if($i==1) :// Primeiro nível ?>
                                                        <?php 
                                                        $fatherOrMother = ($ii%2 == 0 ? 'mother' : 'father');
                                                        $valueSelected = get_post_meta($post->ID, $fatherOrMother, true);
                                                        ?>
                                                        <select class="pedigree_select" data-pai="<?php echo $valueSelected ?>" name="pedigree[<?php echo $post->ID ?>][<?php echo $fatherOrMother ?>]">
                                                            <option value=""><?php _e('Select', 'animalsfastdezineplugin'); ?></option>
                                                        </select>
                                                    <?php else : // A partir do segundo nível ?>
                                                        <?php echo $selectHtml ?>
                                                    <?php endif; ?>
                                                </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php if ($i < $levels) : ?>
                                        <td>
                                            <table style="height: 100%; width: 100%;">
                                                <tr><td style="height: 25%; "></td></tr>
                                                <tr><td style="height: 25%; width: 10px; border-top: 1px dotted #999; border-left: 1px dotted #999; "></td></tr>
                                                <tr><td style="height: 25%; width: 10px; border-bottom: 1px dotted #999; border-left: 1px dotted #999;"></td></tr>
                                                <tr><td style="height: 25%;  "></td></tr>
                                            </table>
                                        </td>
                                        <?php endif; ?>
                                </tr>
                            <?php endfor; ?>
                        </table>
                    </td>
                <?php endfor; ?>
            </tr>
        </table>
    </div>

</div>


<script type="text/javascript">
    
    var AnimaisArr = <?php echo json_encode($itens); ?>;
    
    jQuery(function() {
        
        var $selects = jQuery('.pedigree_select');

        $selects.each(function(){           
            var $this = jQuery(this);

            var idPai = $this.data('pai');
			
			
            
            for(var i in AnimaisArr){
				var animal = AnimaisArr[i];
                $this.append('<option value="'+animal.id+'" '+(idPai == animal.id ? 'selected="selected"' : '')+' >'+animal.nome+'</option>');
            }            
        });

        $selects.change(function(){
            var post_id = jQuery(this).val();
            if(post_id != '') {
                var pedigreeItem = jQuery(this).closest('.pedigree_item');
                var thisRow = parseInt(pedigreeItem.attr('prow'));
                var thisCol = parseInt(pedigreeItem.attr('pcol'));
                var fatherContainer = jQuery('#pedigree_item_'+(thisCol+1)+'_'+(thisRow*2-1));
                var motherContainer = jQuery('#pedigree_item_'+(thisCol+1)+'_'+(thisRow*2));
                if(fatherContainer.length) {
                    fatherContainer.children('.loading:first').show();
                    fatherContainer.children('.pedigree_select:first').attr('disabled',true);
                    jQuery.post('<?php echo $pluginsUrl ?>/animalsfastdezineplugin/pedigree/admin/ajax.php',{'id':post_id,'parent':'father'},function(result){
                        result = result.trim();
                        fatherContainer.children('.pedigree_select:first').attr('name','pedigree['+post_id+'][father]').val(result).css('visibility','visible').change();
                        fatherContainer.children('.loading:first').hide();
                        fatherContainer.children('.pedigree_select:first').attr('disabled',false);
                    });
                }
                if(motherContainer.length) {
                    motherContainer.children('.loading:first').show();
                    motherContainer.children('.pedigree_select:first').attr('disabled',true);
                    jQuery.post('<?php echo $pluginsUrl ?>/animalsfastdezineplugin/pedigree/admin/ajax.php',{'id':post_id,'parent':'mother'},function(result){
                        result = result.trim();
                        motherContainer.children('.pedigree_select:first').attr('name','pedigree['+post_id+'][mother]').val(result).css('visibility','visible').change();
                        motherContainer.children('.loading:first').hide();
                        motherContainer.children('.pedigree_select:first').attr('disabled',false);
                    });
                }
            }
        });

        $selects.each(function(){
            jQuery(this).change();
        });
    });
</script>

