<?php
/**
 * Template Name: Lojas
 */

include_once 'wp-content/plugins/Lojas/Controllers/LojasController.php';
$Lojas = new Lojas();


$dadosCidades = $Lojas->obterCidades();

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
               <?php
               if($dadosCidades)
               {
                   foreach($dadosCidades as $cidade)
                   {?>
                      <div class="cidade">
                          <div class="nome-cidade">
                                <?php echo ucfirst($cidade->nome); ?>    
                          </div>
                          
                          <div class="lojas-cidade" >
                              <?php 
                                    $dadosLojas = $Lojas->obterLojasPorCidade($cidade->nome);
                              
                                    if($dadosLojas)
                                    {
                                        foreach($dadosLojas as $lojas)
                                        {?>
                                           <div class="loja">
                                               <?php 
                                                    if($lojas->farmacia_popular == 'sim')
                                                    {?>
                                                        <div class="banner-loja farmacia-popular"></div>
                                                    <?php
                                                    }
                                                    else 
                                                    {?>
                                                       <div class="banner-loja"></div>
                                                    <?php 
                                                    }
                                               ?>
                                               <div class="nome-loja">
                                                   <?php echo $lojas->nome; ?>
                                               </div>
                                               <div class="endereco-loja">
                                                   <?php echo $lojas->endereco; ?>
                                               </div>
                                               
                                               <div class="telefone">
                                                   <?php echo $lojas->telefone; ?>
                                               </div>
                                           </div>
                                           
                                        <?php 
                                        }
                                    }
                              ?>
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