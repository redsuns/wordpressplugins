<?php
/**
 * Template Name: Ofertas
 */

include_once 'wp-content/plugins/ofertas/core/ofertas-core.php';
$Ofertas = new Ofertas();

$dadosOfertas = $Ofertas->obterOfertas('','ativa');
$dadosImagens = $Ofertas->obterImagens($dadosOfertas->id);

get_header(); ?>
		<div id="primary">
			<div id="content" role="main">
               <?php
               if($dadosOfertas)
               {
                   foreach($dadosOfertas as $ofertas)
                   {?>
                      <div class="oferta">
                          <div class="nome-parceiro">
                                <?php echo $ofertas->mes; ?>  
                          </div>
                          
                          <div class="imagem_principal" >
                              <!-- aqui vai ser mostrada a imagem maior das ofertas -->
                          </div>
                          <div class="imagens_miniaturas" >
                              <?php
                                    foreach($dadosImagens as $imagem)
                                    {?>
                                       <div class="miniatura">
                                           <img src="/wp-content/uploads/ofertas/<?php echo $imagem->imagem; ?>" 
                                                title="<?php echo $imagem->imagem; ?>" 
                                                onclick="imagemDestaque('<?php echo $imagem->imagem ?>')" />
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
        var imagem = "<?php echo get_bloginfo('url'); ?>wp-content/uploads/ofertas/"+img;
        jQuery('.imagem_principal').attr('');
        jQuery('.imagem_principal').attr(imagem);
    }
</script>
