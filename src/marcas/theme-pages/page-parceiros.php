<?php
/**
 * Template Name: Parceiros
 */

include_once 'wp-content/plugins/parceiros/core/coreParceiros.php';
$Parceiros = new Parceiros();


$dadosParceiros = $Parceiros->obterParceiros();

get_header(); ?>
        <div class="meio clearfix">
	        <div class="conteudo-1005">
	        <?php while ( have_posts() ) : the_post(); ?>
	        	<div class="titulo-ofertas">
		        	<h2><?php the_title(); ?></h2>
	        	</div>
	        	<div class="conteudo clearfix">
	        		<?php the_content(); ?>
	        		<div class="clear"></div>

		        		
	               <?php
	               if($dadosParceiros)
	               {
	                   foreach($dadosParceiros as $parceiro)
	                   {?>
	                   		<div class="box-convenios" align="center">	
	                   		<a href="<?php echo $parceiro->url; ?>"> 
	                   			<div class="corta-imagem">
	                   			</div>                         
	                          <div class="banner-parceiro" >
	                              <?php
	                              		if(file_exists('./wp-content/uploads/parceiros/'.$parceiro->imagem))
										{
											$imagem = get_bloginfo('url').'/wp-content/uploads/parceiros/'.$parceiro->imagem;
										}
										else 
										{
											$imagem = './wp-content/plugins/parceiros/sources/imagens/no-banner.png';	
										}
	                              ?>
	                              
	                              	<img src="<?php echo $imagem; ?>" width="200" title="<?php echo $parceiro->nome; ?> " />
	                           
	                          </div>
	                             </a>

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
<?php get_footer(); ?>




