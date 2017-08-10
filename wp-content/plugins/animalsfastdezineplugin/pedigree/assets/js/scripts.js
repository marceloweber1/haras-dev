(function($){

    $('document').ready(function(){
		
		
		$('.container_pedigree').each(function(){	

			var $container = $(this);
			
			$container.find('.cavalo').on('click', function(){
				var $this = $(this);
				if($this.find('a').length > 0){
					$.fancybox(
						$this.find('.box')[0].outerHTML,
						{
							maxWidth: 500
						}
					);
				}
			});

			var widthAtual = null;

			function setBolinhas(){
				
				var $parent = $container.parent();				
				var $bolContainer = $parent.find('.bolinhas-container');

				var width = $parent.width();
				var widthContainer = $container[0].scrollWidth;

				function configureEvents(){

					removeEvents(true);

					var widthLinha = $container.find('.linha-0').width();

					var widthNovo = parseInt(width / parseInt(width / widthLinha));
					
					widthContainer = 4 * widthNovo;

					$container.find('.linha').css('width', widthNovo-15).not('.linha-0').css('margin-left', widthNovo);

					var numBolinhas = 0;

					var numPaginas = Math.ceil(widthContainer / width);
					
					for(var i = 0; i < numPaginas; i++){

						var bolinha = $('<i></i>').data('numero', i);

						var left = i * width;

						if(left > (widthContainer - width)){
							left = widthContainer - width;
						}
						
						bolinha.data('left', left);
						$bolContainer.append(bolinha);
						numBolinhas++;

					}
					
					$bolContainer.on('click', 'i', function(){

						var $this = $(this);
						var numero = $this.data('numero');
						var left = $this.data('left');

						$bolContainer.find('.ativo').removeClass('ativo');
						$this.addClass('ativo');

						$container.stop(true, false).animate({left: -(left)});

					});

					$container.data('bola', 0);

					$container.swipe( {
						swipe:function(event, direction) {
							var nBola = $container.data('bola');
							if(direction == 'left'){
								nBola++;
								if(nBola > numBolinhas-1){
									return;
								}
							}else if (direction == 'right'){
								nBola--;
								if(nBola < 0){
									return;
								}
							}
							$container.data('bola', nBola);
							$bolContainer.find('i').eq(nBola).trigger('click');
						},
						allowPageScroll:"vertical"
					});

					$bolContainer.find('i').eq(0).addClass('ativo');

					$container.find(".nome").dotdotdot({watch:true});

				}

				function removeEvents(removeWidth){
					$bolContainer.empty().off('click', 'i');
					$container.css({left: 0}).stop(true, true).swipe("destroy");
					if(removeWidth){
						$container.find('.linha').css('width', '').css('margin-left', '');
					}
				}
				
				if(width == widthAtual){
					return;
				}
				
				if(width < 940){
					configureEvents();
				}else{
					removeEvents(true);
				}

				widthAtual = width;

			}

			$(window).resize(setBolinhas).trigger('resize').trigger('resize');

			$container.find(".nome").dotdotdot({watch:true});			
			
		});

    });

})(jQuery);