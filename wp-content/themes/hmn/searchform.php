<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="col-xs-8 col-md-10 col-sm-10 col-lg-10">
			<input type="search" name="s" value="<?php echo get_search_query(); ?>" id="s" placeholder="Faça sua busca" class="">
		</div>
		<div class="col-xs-4 col-md-2 col-sm-2 col-lg-2">
			<input type="submit" value="Buscar" class="btn-buscar">
		</div>
	</div>
</form>