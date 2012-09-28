<?php
/**
 * Template Name: Parceiros
 */

include_once 'wp-content/plugins/parceiros/core/coreParceiros.php';
$Parceiros = new Parceiros();


$dadosParceiros = $Parceiros->obterParceiros();

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
               <?php
               if($dadosParceiros)
               {
                   foreach($dadosParceiros as $parceiro)
                   {?>
                      <div class="parceiro">
                          <div class="nome-parceiro">
                                <?php echo $parceiro->nome; ?>  
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
                              <a href="<?php echo $parceiro->url; ?>">
                              	<img src="<?php echo $imagem; ?>" width="128" />
                              </a>
                          </div>
                      </div>
                      
                   <?php 
                   }
               }
              ?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>