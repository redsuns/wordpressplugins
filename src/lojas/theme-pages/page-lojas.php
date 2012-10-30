<?php
/**
 * Template Name: Lojas
 * Description: Aqui será montado o layout para apresentação das lojas
 * Sempre será chamada a principal cidade da região metropolitana
 * e esta terá distinção de lojas do centro e dos bairros, nas demais cidade
 * as lojas serão agrupadas como um todo
 */

include_once 'wp-content/plugins/lojas/core/lojas-core.php';
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
       	
       	// listando lojas do Centro de Curitiba
       	// Aqui pode ser definida uma cidade qualquer
       	if($dadosCuritiba)
       	{
           	foreach($dadosCuritiba as $curitiba)
           	{?>
              	<div class="conteudo-endereco clearfix">
                  	<h2><?php echo ucfirst($curitiba->nome); ?></h2> 
                  	<div class="lojas-cidade" >
                    <?php
                        $dadosLojas = $Lojas->obterLojasPorBairro('Centro','Curitiba');
                      
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
                                   		<p class="horario-funcionamento"><?php echo $lojas->horario_funcionamento; ?></p>
                       				</div>
                     <?php  }
                        }?>
                  					</div>
              		</div>
              		
           <?php 
           }
       	}

        // buscando demais bairros de Curitiba, definind que o Centro não se encaixe na pesquisa
        $dadosBairros = $Lojas->obterBairros('Curitiba','Centro');
        
        if($dadosBairros)
        {
            foreach($dadosBairros as $bairro)
            {?>
            <div class="conteudo-endereco clearfix">
                <h3><?php echo ucfirst($bairro->nome); ?>   </h3> 
                <div class="lojas-cidade" >
                    
                <?php
                    
                    $dadosLojasBairros = $Lojas->obterLojasPorBairro($bairro->nome,'Curitiba');
                    
                    foreach($dadosLojasBairros as $dadosLojasBairros)
                    {
                       if($dadosLojasBairros->farmacia_popular == 'sim')
                        {?>
                           <div class="box-endereco ativo">
                           <?php
                        }
                        else 
                        {?>
                            <div class="box-endereco">
                        <?php 
                        }?>
                                <p class="endereco"><?php echo $dadosLojasBairros->endereco; ?></p>
                                <p class="telefone"><?php echo $dadosLojasBairros->telefone; ?></p>
                            </div>
              <?php } ?>
                            </div>
                </div>
            <?php 
            }
        }

        // buscando por demais cidades, estas cidades não terão distinção entre lojas do centro e de bairros
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
                       <?php }
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
