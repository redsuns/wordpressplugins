<?php
/**
 * Template Name: Lojas
 */

include_once 'wp-content/plugins/lojas/core/coreLojas.php';
$Lojas = new Lojas();
$dadosCuritiba = $Lojas->obterCidades('Curitiba');
$dadosCidades = $Lojas->obterCidades('', 'Curitiba');

get_header(); ?>
   <div class="meio clearfix">
    <div class="conteudo-1005">
    	<div class="titulo-ofertas">
        	<h2>Nossas Lojas</h2>
    	</div>
    	
    	<div class="conteudo clearfix">
       	<?php
       	// Buscando bairros de Curitiba
       	if($dadosCuritiba)
       	{
           	foreach($dadosCuritiba as $curitiba)
           	{?>
              	<div class="conteudo-endereco clearfix">
                  	<h2><?php echo ucfirst($curitiba->nome); ?></h2> 
                  	<div class="lojas-cidade" >
                    <?php
                    	// listando lojas do Centro 
                        $dadosLojas = $Lojas->obterLojasPorBairro('Centro');
                      
                        if($dadosLojas)
                      	{?>
                        	<h3>Centro</h3>
                           	<?php
                            foreach($dadosLojas as $lojas)
                            {?>
                           <?php  if($lojas->farmacia_popular == 'sim')
                                {?>
                                    <div class="box-endereco ativo">
                          <?php }
                                else 
                                {?>
                                   	<div class="box-endereco">
                          <?php }?>
                                   		<p class="endereco"><?php echo $lojas->endereco; ?></p>
                                   		<p class="telefone"><?php echo $lojas->telefone; ?></p>
                       				</div>
                            <?php 
                            }
                        }?>
                  					</div>
              		</div>
           <?php 
           }
									
		   foreach($dadosCuritiba as $bairrosCuritiba)
           {
           		 // Lisatando lojas dos bairros com excessão do Centro
           	     $dadosLojas = $Lojas->obterLojasPorBairro("","'Centro' and cidade='Curitiba'");
                  
	                        if($dadosLojas)
	                        {
	                            foreach($dadosLojas as $lojas)
	                            {?>
	                            	<div class="conteudo-endereco clearfix">
   
                  					<div class="lojas-cidade" >
          							<?php
		                            	if($lojas->farmacia_popular == 'sim')
		                                {?>
		                                    <div class="box-endereco ativo">
		                                <?php
		                                }
		                                else 
		                                {?>
		                                   	<div class="box-endereco">
		                                <?php 
		                                }?>
			                                   <h3><?php echo $lojas->nome; ?></h3>
			                                   <p class="endereco"><?php echo $lojas->endereco; ?></p>
			                                   <p class="telefone"><?php echo $lojas->telefone; ?></p>
											</div>
	                      <?php } 
	                        
							}?>
                  						</div>
              						</div>
             				 	</div>
           	<?php 
           	}							
       	}

		if($dadosCidades)
       	{
           	foreach($dadosCidades as $cidade)
           	{?>
			<div class="conteudo-endereco clearfix">
				<h2><?php echo ucfirst($cidade->nome); ?>   </h2> 
	          	<div class="lojas-cidade" >
	            <?php 
					$dadosLojas = $Lojas->obterLojasPorCidade($cidade->nome);
	              
                    	if($dadosLojas)
                    	{
                        	foreach($dadosLojas as $lojas)
                        	{?>
                       		<?php  
                       			if($lojas->farmacia_popular == 'sim')
                                {?>
                                   <div class="box-endereco ativo">
                                   <?php
                                }
                                else 
                                {?>
                                   	<div class="box-endereco">
                                <?php 
                                }?>
		                               	<h3><?php echo $lojas->nome; ?></h3>
		                               	<p class="endereco"><?php echo $lojas->endereco; ?></p>
		                               	<p class="telefone"><?php echo $lojas->telefone; ?></p>
                           			</div>
                        	<?php 
                        	}
                    	}?>
	          					</div>
	      		</div>
	   		<?php 
	   		}
       	}?>
    	<div class="fio"></div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>
