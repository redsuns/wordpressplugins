<?php
/**
 * Template Name: Ofertas
 */

get_header(); 

include_once 'wp-content/plugins/ofertas/core/ofertas-core.php';
$Ofertas = new Ofertas();

$dadosOfertas = $Ofertas->obterOfertas('','ativa');
?>

        <div class="meio clearfix">
	        <div class="conteudo-1005">
	        <?php while ( have_posts() ) : the_post(); ?>
	        	<div class="titulo-ofertas">
		        	<h2>Ofertas</h2>
	        	</div>
	        	<div class="conteudo clearfix">
	        	
               <?php
               if($dadosOfertas)
               {
                   foreach($dadosOfertas as $ofertas)
                   {?>
                      <div class="oferta">
                          <div class="mes-atual" style="display:none;">
                                <?php echo $ofertas->mes; ?>  
                          </div>
                          
                          <div class="imagem_principal" >
                              <?php
                                    $count = 1;
                                    $dadosImagens = $Ofertas->obterImagens($ofertas->id);
                                    foreach($dadosImagens as $imagem)
                                    {?>
                                       <img src="./wp-content/uploads/ofertas/<?php echo $imagem->imagem; ?>" 
                                            title="<?php echo $imagem->imagem; ?>" 
                                            class="img-<?php echo $count ?> ofertas-principal" ;
                                       />      
                                       
                                                
                                    <?php 
                                    	$count++;
                                    }  
                                      
                              ?>
								<script type="text/javascript">
									var qtdImagens = <?php echo $count-1 ?>;
								</script>                           
                              <div class="prev">Prev</div>
                              <div class="next">Next</div>
                          </div>
                          <ul class="imagens_miniaturas jcarousel-skin-tango" id="mycarousel" >
                              <?php
                                    $count2 = 1;
                                    $dadosImagens = $Ofertas->obterImagens($ofertas->id);
                                    foreach($dadosImagens as $imagem)
                                    {?>
                                       <li class="miniatura">
    
                                           <img src="./wp-content/uploads/ofertas/thumbs/<?php echo $imagem->imagem; ?>" 
                                                title="<?php echo $imagem->imagem; ?>" 
                                                width="80"
                                                class="img-thumb-<?php echo $count2 ?>"
                                                 />
                                       </li>
                                    <?php 
                                    $count2++;
                                    }    
                          ?>
                          </ul>
                      </div>
                   <?php 
                   }
               }
              ?>
			
	        	</div>
    
	        	<div class="fio"></div>
	        <?php endwhile; // end of the loop. ?>
	        </div>
        </div>


	<script type="text/javascript">
	var Atual;
	var cont=1;
	Atual = ".img-1.ofertas-principal";	
	$(Atual).fadeIn();
	
	$(".next").click(function(){
		$(Atual).fadeOut("slow", function(){
			if(cont >= qtdImagens){
				Atual = ".img-1.ofertas-principal";	
				cont = 1;
				$(Atual).fadeIn();						
			}else{
				cont++;
				Atual = ".img-"+cont+".ofertas-principal";	
				$(Atual).fadeIn();						
			}
		});
	});
	
	$(".prev").click(function(){
		$(Atual).fadeOut("slow", function(){
			if(cont<=1){
				Atual = ".img-"+qtdImagens+".ofertas-principal";	
				cont = qtdImagens;
				$(Atual).fadeIn();					
			}else{
				cont--;
				Atual = ".img-"+cont+".ofertas-principal";	
				$(Atual).fadeIn();		
			}
		});
	});
		
	$(".img-thumb-1").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-1.ofertas-principal";	
			cont = 1;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-2").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-2.ofertas-principal";	
			cont = 2;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-3").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-3.ofertas-principal";	
			cont = 3;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-4").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-4.ofertas-principal";	
			cont = 4;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-5").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-5.ofertas-principal";	
			cont = 5;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-6").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-6.ofertas-principal";	
			cont = 6;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-7").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-7.ofertas-principal";	
			cont = 7;
			$(Atual).fadeIn();			
		});
	});
	$(".img-thumb-8").click(function(){
		$(Atual).fadeOut("slow", function(){
			Atual = ".img-8.ofertas-principal";	
			cont = 8;
			$(Atual).fadeIn();			
		});
	});
	
	
	
	</script>
			
<?php get_footer(); ?>
