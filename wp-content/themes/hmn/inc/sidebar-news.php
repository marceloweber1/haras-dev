<div class="container-sidebar">
	<div class="sidebar text-center">
		<h5 class="tilt-internas detal-title">Categorias</h5>
	</div>
	<div class="interno-sidebar text-center">
		<?php
			//list terms in a given taxonomy
			$taxonomy = 'clipping_categoria';
			$tax_terms = get_terms($taxonomy);
		?>
		<ul>
		<?php
			foreach ($tax_terms as $tax_term) {
				echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
			}
		?>
		</ul>
	</div>

	<div class="sidebar text-center">
		<h5 class="tilt-internas detal-title">Arquivos</h5>
	</div>
	<div class="interno-sidebar arquivos text-center">
		<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;" class="form-control">
			<option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option>
			<?php wp_get_archives( array( 'post_type' => 'clipping', 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 0 ) ); ?>
		</select>
	</div>
</div>