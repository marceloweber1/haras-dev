<?php

$pedigreeOrder = array(
    'pai' => array(
        'paipai' => array(
            'paipaipai',
            'maepaipai'
        ),
        'maepai' => array(
            'paimaepai',
            'maemaepai'
        ),
    ),
    'mae' => array(
        'paimae' => array(
            'paipaimae',
            'maepaimae'
        ),
        'maemae' => array(
            'paimaemae',
            'maemaemae'
        )
    )
);

function saveParentAnimal($idChild,$fatherOrMother,$item) {
		
    if(!empty($item["_{$fatherOrMother}registro"]) && !empty($idChild) && trim($item["_{$fatherOrMother}nome"]) != ""){
        // Verifica se existe
        $fatherOrMotherExist = get_posts(array(
            'post_status' => 'any',
            'posts_per_page' => 1,
            'post_type' => 'cavalo',
            'meta_query' => array(
                array(
                    'key'     => 'association_number',
                    'value'   => $item["_{$fatherOrMother}registro"],
                    'compare' => '='
                )
            )
        ));
				
        // Se existe, usa o ID dele, se não, cadastra o pai para depois suar o ID
        $fatherOrMother_id = NULL;
        if(count($fatherOrMotherExist) && !empty($fatherOrMotherExist[0])) {
            $fatherOrMother_id = $fatherOrMotherExist[0]->ID;
        } else {
            $idInsert = wp_insert_post(array(
                'post_type' => 'cavalo',
                'post_status' => 'parents',
                'post_title' => $item["_{$fatherOrMother}nome"],
            ));
            if($idInsert) {
                update_post_meta($idInsert, 'association_number', $item["_{$fatherOrMother}registro"]);
				$associations = array(
					array(
						'association_name' => 'ABCCMM',
						'association_number' => $item["_{$fatherOrMother}registro"],
					)
				);
				update_field('field_55de1f8aca0f6', $associations, $idInsert);				
                $fatherOrMother_id = $idInsert;
            }
        }
        // Salva o pai para o filho
        if($fatherOrMother_id) {
            $keyMeta = (substr($fatherOrMother, 0, 3) == 'pai' ? 'father' : 'mother');
            update_post_meta($idChild, $keyMeta, $fatherOrMother_id);
            return $fatherOrMother_id;
        }
    }
}

function getDataCSV($file){

    $content = file_get_contents($file);
    $contentExplodeRows = explode("\n", $content);
    $fields = array();
    $data = array();
    foreach($contentExplodeRows as $key=>$contentExplodeRow) {
        $colsRow = explode(';', $contentExplodeRow);
        if(count($colsRow) > 1) {
            if($key == 0) {
                foreach($colsRow as $key => $colRow) {
                    $colsRow[$key] = trim($colRow);
                }
                $fields = $colsRow;
            } else {
                $dataItem = array();
                foreach($colsRow as $key=>$colRow) {
                    $dataItem[$fields[$key]] = utf8_encode(trim($colRow));
                }
                $data[] = $dataItem;
            }
        }
    }

    return $data;

}

function getDataXLS($file, $sheet = 1){

    require_once(__DIR__."/libs/PHPExcel/IOFactory.php");    
    $data = array();

    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $sheetCount = $objPHPExcel->getSheetCount();
	    
    if($sheetCount == 3){
        $sheet = $objPHPExcel->setActiveSheetIndex($sheet);
    }else{
        $sheet = $objPHPExcel->getActiveSheet();
    }
    
    $xlsData = $sheet->toArray(null,true,true,true);
    
    if(count($xlsData) > 1){        
        if($xlsData[1]['A'] != '_rowid'){
            array_shift($xlsData);    
        }
        $keys = array_values(array_shift($xlsData));
        foreach($xlsData as $row){
            $data[] = array_combine($keys, $row);
        }
    }   

    return $data;
}

function parseDataXls($date){
    
    $dateOfBirth = "";
	    
    if(substr_count($date, "/") == 2){
        $date = explode("/", $date);
        $dateOfBirth = $date[2] 
            . str_pad($date[1], 2, "0", STR_PAD_LEFT)
            . str_pad($date[0], 2, "0", STR_PAD_LEFT);
    }elseif(substr_count($date, "-") == 2){
        $date = explode("-", $date);
        $dateOfBirth = ($date[2] > 20 ? "19".$date[2] : "20".$date[2])
            . str_pad($date[0], 2, "0", STR_PAD_LEFT)
            . str_pad($date[1], 2, "0", STR_PAD_LEFT);
    }
    
    return $dateOfBirth;
    
}