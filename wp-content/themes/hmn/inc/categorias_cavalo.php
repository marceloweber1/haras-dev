<?php
//list terms in a given taxonomy

global $wp_query;

$termoAtual = $wp_query->query_vars['cavalo_categoria'];
$isVenda = $wp_query->query_vars['venda'];
$taxonomy = 'cavalo_categoria';
$tax_terms = get_terms($taxonomy, array('hide_empty' => false, 'exclude' => '14', 'orderby' => 'term_id'));


foreach ($tax_terms as $tax_term) {
    $termSlug = $tax_term->slug;    
    $link = esc_attr(get_term_link($tax_term, $taxonomy));
    if($isVenda){
        $link = str_replace("cavalo_categoria", "vendas", $link);
    }    
    ?>
    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo $link ?>" <?php if($termSlug == $termoAtual){ ?>class="active"<?php } ?>><?php echo $tax_term->name; ?></a>
    </div>
<?php } ?>