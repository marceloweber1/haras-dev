<?php

$totalImportados = 0;
$totalAtualizados = 0;
$totalExistentes = 0;

$importouHorses = false;
$importouAwards = false;

### IMPORTAR CAVALOS
if(isset($_FILES['horse_file']) && isset($_FILES['horse_file']['tmp_name']) && !empty($_FILES['horse_file']['tmp_name'])) {

    $name = $_FILES['horse_file']['name'];
    $tmpName = $_FILES['horse_file']['tmp_name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $data = array();

    if($ext == "csv"){
        $data = getDataCSV($tmpName);
    }elseif($ext == "xls" || $ext == "xlsx"){
        $data = getDataXLS($tmpName);
    }
    
    $breeders = array();
    
    $itens = get_posts(array('post_type' => 'criador'));
    
    foreach($itens as $item){
        $breeders[strtoupper($item->post_title)] = $item->ID;    
    }
	    
    foreach($data as $item) {
        
        if(trim($item['_rowid']) == ""){
            continue;
        }
        
        $dateOfBirth = parseDataXls($item['_datanascto']);

        try{
            $dateOfBirthObj = new DateTime($dateOfBirth);
            $hoje = new DateTime();
            $interval = $hoje->diff($dateOfBirthObj);
            $meses = $interval->m + ($interval->y * 12);
        }catch(Exception $e){
            $meses = 0;
        }     
	        
        if($item['_sexo'] == "C"){
            $item['_sexo'] = "Castrado";
        }else{          
                        
            if($item['_sexo'] == "M"){                
                if($meses >= 36){
                    $item['_sexo'] = "Garanhão";
                }else{
                    $item['_sexo'] = "Potro";
                }                
            }elseif($item['_sexo'] == "F"){
                if($meses >= 36){
                    $item['_sexo'] = "Égua";
                }else{
                    $item['_sexo'] = "Potra";
                }
            }            
            
        }
        
        if($item['_exame'] != ""){
            $item['_exame'] = "Sim";
        }else{
            $item['_exame'] = "Não";
        }
        
        $metaData = array(
            'horse_name' => $item['_nomeAnimal'],
            'breed' => 'Mangalarga Marchador',
            'rowid' => $item['_rowid'],
            'association_name' => 'ABCCMM',
            'association_number' => $item['_registro'],
            'book' => $item['_livro'],
            'date_birth' => $dateOfBirth,
            'gender' => $item['_sexo'],
            'color' => $item['_pelagem'],
            'examination' => $item['_exame'],
            'chip' => $item['_chip']
        );
        
        $associations = array(
            array(
                'association_name' => 'ABCCMM',
                'association_number' => $item['_registro'],
            )
        );
        
        if(!isset($breeders[ strtoupper($item['_Criador']) ])){
            $postIdInsert = wp_insert_post(array(
                'post_type' => 'criador',
                'post_status' => 'publish',
                'post_title' => strtoupper($item['_Criador']),
            ));
            $breeders[ strtoupper($item['_Criador']) ] = $postIdInsert;
        }

        if(!isset($breeders[ strtoupper($item['_proprietario']) ])){
            $postIdInsert = wp_insert_post(array(
                'post_type' => 'criador',
                'post_status' => 'publish',
                'post_title' => strtoupper($item['_proprietario']),
            ));
            $breeders[ strtoupper($item['_proprietario']) ] = $postIdInsert;
        }

        $metaData['breeder'] = $breeders[ strtoupper($item['_Criador']) ];
        $metaData['owner'] = $breeders[ strtoupper($item['_proprietario']) ];
        
        $postsExist = get_posts(array(
            'post_status' => 'any',
            'posts_per_page' => 1,
            'post_type' => 'cavalo',
            'meta_query' => array(
                array(
                    'key'     => 'association_number',
                    'value'   => $item['_registro'],
                    'compare' => '='
                )
            )
        ));
        // Se existe, mas a raça não está preenchida, pode ser um pai ou mãe importada, por isso atualiza
        
        $idChild = null;
        if(count($postsExist) && !empty($postsExist[0])) {
            $postExist = $postsExist[0];
            $breedExists = get_post_meta($postExist->ID, 'breed', true);
			$idChild = $postExist->ID;
            if(empty($breedExists)) {
                foreach($metaData as $key => $value) {
                    update_post_meta($postExist->ID, $key, $value);
                }
                // Altera o cavalos de parents para draft 
                wp_update_post( array('ID' => $postExist->ID, 'post_status' => 'draft') );                
                $totalAtualizados++;
                update_field('field_55de1f8aca0f6', $associations, $postExist->ID);
            } else {
                $totalExistentes++;
            }
        } else {
            // Insere um novo cavalo
            $postIdInsert = wp_insert_post(array(
                'post_type' => 'cavalo',
                'post_status' => 'draft',
                'post_title' => $item['_nomeAnimal'],
            ));
            if($postIdInsert) {
                foreach($metaData as $key => $value) {
                    add_post_meta($postIdInsert, $key, $value);
                }
                $idChild = $postIdInsert;
                $totalImportados++;
            }
            update_field('field_55de1f8aca0f6', $associations, $postIdInsert);
        }

        // Inserir Pedigree
		
        if(!empty($idChild)) {
            // Importa a genealogia
            foreach($pedigreeOrder as $fatherOrMother => $nivel2) {
                $idChild_nivel2 = saveParentAnimal($idChild,$fatherOrMother,$item);
                foreach($nivel2 as $fatherOrMother_nivel2 => $nivel3) {
                    $idChild_nivel3 = saveParentAnimal($idChild_nivel2,$fatherOrMother_nivel2,$item);
                    foreach($nivel3 as $fatherOrMother_nivel3) {
                        saveParentAnimal($idChild_nivel3,$fatherOrMother_nivel3,$item);
                    }
                }
            }
        }
		
        $importouHorses = true;

    }
		
}


### IMPORTAR PREMIAÇÕES
if(isset($_FILES['award_file']) && isset($_FILES['award_file']['tmp_name']) && !empty($_FILES['award_file']['tmp_name'])) {
    
    $name = $_FILES['award_file']['name'];
    $tmpName = $_FILES['award_file']['tmp_name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $data = array();

    if($ext == "csv"){
        $data = getDataCSV($tmpName);
    }elseif($ext == "xls" || $ext == "xlsx"){
        $data = getDataXLS($tmpName, 2);
    }

    $counter = array();

    foreach($data as $item) {
        
        $rowid = $item['rowid'];

        $postsExist = get_posts(array(
            'post_status' => 'any',
            'posts_per_page' => 1,
            'post_type' => 'cavalo',
            'meta_query' => array(
                array(
                    'key'     => 'rowid',
                    'value'   => $rowid,
                    'compare' => '='
                )
            )
        ));
        
        if(count($postsExist) && !empty($postsExist[0])) {
            $cavalo = $postsExist[0];  
                        
            if(!isset($counter[$cavalo->ID])){
                $counter[$cavalo->ID] = get_post_meta($cavalo->ID);
            }           
            
            $row = $counter[$cavalo->ID];
            
            $metaData = array(
                'content_awards_'.$row.'_event_awards' => $item['NomeExposicao'],
                'content_awards_'.$row.'_city_awards' => $item['CidadeEstado'],
                'content_awards_'.$row.'_period_awards' => $item['Periodo'],
                'content_awards_'.$row.'_award' => $item['Premiacao'],
                'content_awards_'.$row.'_number_of_partipating_animals_award' => $item['Quantidadejulgamentos']
            );

            foreach($metaData as $key => $value) {
                update_post_meta($cavalo->ID, $key, $value);
            }

            $counter[$cavalo->ID]++;
            $totalImportados++;

        }

        $importouAwards = true;

    }
}