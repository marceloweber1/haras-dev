<?php

add_action('acf/input/admin_head', 'animalsfastdezineplugin_acf_admin_head');
function animalsfastdezineplugin_acf_admin_head() {
    ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function(){                
                $('.remove-add .acf-repeater-add-row').remove();                
            });
        })(jQuery);
    </script>
    <style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: transparent;
            padding-top: 0;
        }
        .no-input .acf-input {
            display: none;
        }
        .select-full{
            min-height: 0 !important;
        }
        .select-full .categorychecklist-holder{
            height: auto;
            max-height: none;
        }
        .acf-row{
            border-bottom-width: 5px;
        }
    </style>
<?php

}

add_filter('acf/settings/default_language', 'animalsfastdezineplugin_default_language');
function animalsfastdezineplugin_default_language( $language ) {
    return 'pt-br';
}

add_filter('acf/settings/current_language', 'animalsfastdezineplugin_current_language');
function animalsfastdezineplugin_current_language( $language ) {
    return 'pt-br';
}

require_once(__DIR__."/acf/page-galeria-fotos.php");
require_once(__DIR__."/acf/cpt-evento.php");
require_once(__DIR__."/acf/cpt-criador.php");
require_once(__DIR__."/acf/cpt-cavalo.php");
require_once(__DIR__."/acf/cpt-selo.php");
require_once(__DIR__."/acf/cpt-parceiro.php");