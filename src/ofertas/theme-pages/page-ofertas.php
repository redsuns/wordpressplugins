<?php
/**
 * Template Name: Ofertas
 */

get_header(); 

include_once 'wp-content/plugins/ofertas/core/ofertas-core.php';
$Ofertas = new Ofertas();

$dadosOfertas = $Ofertas->obterOfertas('','ativa');
?>
		<div id="primary">
			<div id="content" role="main">
               <?php
               if($dadosOfertas)
               {
                   foreach($dadosOfertas as $ofertas)
                   {?>
                      <div class="oferta">
                          <div class="mes-atual">
                                <?php echo $ofertas->mes; ?>  
                          </div>
                          
                          <div class="imagem_principal" >
                              <!-- aqui vai ser mostrada a imagem maior das ofertas -->
                          </div>
                          <div class="imagens_miniaturas" >
                              <?php
                                    
                                    $dadosImagens = $Ofertas->obterImagens($ofertas->id);
                                    foreach($dadosImagens as $imagem)
                                    {?>
                                       <div class="miniatura">
                                           <a href="javascript:;">
                                           <img src="./wp-content/uploads/ofertas/<?php echo $imagem->imagem; ?>" 
                                                title="<?php echo $imagem->imagem; ?>" 
                                                onclick="imagemDestaque('<?php echo $imagem->imagem ?>')"
                                                width="152" />
                                           </a>
                                       </div>
                                    <?php 
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
<script type="text/javascript">
    function imagemDestaque(img)
    {
        var imagem = "<div class='imagem'>";
            imagem += "<img src='<?php echo get_bloginfo('url'); ?>/wp-content/uploads/ofertas/"+img+"'>";
            imagem += "</div>";
        jQuery('.imagem_principal').html(imagem);
    }
</script>