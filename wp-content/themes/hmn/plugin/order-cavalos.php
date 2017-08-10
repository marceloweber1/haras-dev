<?php

global $wpdb;

if($_GET['reset']){
	
	$sql = "SELECT ID, post_title, post_status FROM {$wpdb->posts} WHERE post_type IN ('cavalo') AND post_status IN ('publish') ORDER BY menu_order DESC, post_title ASC";
	$ids = [];
	foreach($wpdb->get_results($sql) as $animal){
		$sexo = get_field('gender', $animal->ID);				
		if($sexo == $_GET['reset']){
			$ids[] = $animal->ID;
		}
	}
	
	if(count($ids) > 0){
		$sql = "UPDATE {$wpdb->posts} SET menu_order = '0' WHERE ID IN (".implode(',', $ids).")";
		$wpdb->query($sql); 
	}	
	echo "<script>alert('Ordem resetada com sucesso!'); location.href = 'admin.php?page=horse-animal-order';</script>";	
	exit;	
	
}

if($_POST){
	foreach($_POST as $gender => $animais){		
		$json = json_decode(stripslashes($animais));		
		$alterados = [];
		foreach($json[0] as $i){
			if($i->order == 1){
				$alterados[] = $i->id;
			}
		}		
		$t = count($alterados);		
		if($t > 0){
			$t++;
			foreach($alterados as $id){
				$sql = "UPDATE {$wpdb->posts} SET menu_order = '".$t."' WHERE ID = '".$id."'";
				$wpdb->query($sql); 
				$t--;
			}
		}		
	}
    echo "<script>alert('Ordem salva com sucesso!');</script>";
}

$sql = "SELECT ID, post_title, post_status FROM {$wpdb->posts} WHERE post_type IN ('cavalo') AND post_status IN ('publish') ORDER BY menu_order DESC, post_title ASC";
$animais = array(
    'Potro' => array(),
    'Garanhão' => array(),
	'Potra' => array(),
	'Égua' => array(),
	'Castrado' => array()
);

foreach($wpdb->get_results($sql) as $animal){
    $sexo = get_field('gender', $animal->ID);			
	if(!isset($animais[$sexo])){
		continue;
	}
	$animais[$sexo][] = $animal;
}

?>
<style>

body.dragging, body.dragging * {
    cursor: move !important;
}

.dragged {
    position: absolute;
    opacity: 0.5;
    z-index: 2000;
}

ol.sortable li{
    cursor: move;
    border: 1px solid #666666;
    padding: 5px;
    margin-bottom: 4px;
}

ol.sortable li.placeholder {
    position: relative;
    /** More li styles **/
}
ol.sortable li.placeholder:before {
    position: absolute;
    /** Define arrowhead **/
}

</style>
<h1>Ordem dos animais - Cavalo</h1>
<form method="post" action="">

	<div style="width: 750px;">
	
		<?php 
		$i = 0;		
		foreach($animais as $k => $arr){ 		
		$i++;
		?>
		<div style="float: left; width: 220px; margin-right: 20px;">
			<h2><?php echo $k; ?></h2>
			<input type="hidden" name="<?php echo $k; ?>" id="<?php echo $k; ?>" value="" />
			<ol class='sortable' data-group='<?php echo $k; ?>'>
				<?php
				foreach($arr as $animal){
					?>
					<li data-id="<?php echo $animal->ID; ?>" data-order="<?php echo $animal->menu_order > 1 ? 1 : 0; ?>"><?php echo $animal->post_title; ?></li>
				<?php } ?>
			</ol>
			<a href="<?php echo $_SERVER['REQUEST_URI'] ?>&reset=<?php echo $k; ?>" class="button">Resetar ordem</a>
		</div>
		<?php 		
		if($i % 3 == 0){ ?><div style="float: left; width: 100%; height: 10px;"></div><?php }
		} 
		?>
		
		<div style="float: left; width: 100%; height: 10px;"></div>

		<input type="submit" style="float: left;" class="button button-primary button-large" value="Salvar" />
	
	</div>
	
	
</form>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/jquery-sortable.min.js"></script>

<script>

(function($){

    function generateJson(group, id){
        var data = group.sortable("serialize").get();
        var jsonString = JSON.stringify(data);
        $(id).val(jsonString);
    }
	
    $(document).ready(function(){
		
		$('.sortable').each(function(){
			
			var $list = $(this);
			var $input = $list.prev();
			
			var group = $list.data('group');
			
			$list.sortable({
				group: group,
				delay: 500,
				onDrop: function ($item, container, _super) {					
					$item.data('order', 1);					
					generateJson($list, $input);
					_super($item, container);
				}
			});
			
			generateJson($list, $input);			
			
		});

    });

})(jQuery);

</script>





