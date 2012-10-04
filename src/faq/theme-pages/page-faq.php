<?php
/**
 * Template Name: Faq
 * Description: Aqui será montado o layout para apresentação das perguntas e respostas
 * frequentes
 */

include_once 'wp-content/plugins/faq/core/faq-core.php';
$Faq = new Faq();

$dadosFaq = $Faq->obterListaFaq();

get_header(); ?>
   <div class="meio clearfix">
    <div class="conteudo-1005">
    	<div class="titulo-faq">
        	<h2>Perguntas e respostas</h2>
    	</div>
    	
    	<div class="conteudo clearfix">
       	<?php
     
       	if($dadosFaq)
       	{
           	foreach($dadosFaq as $dadosFaq)
           	{?>
              	<div class="conteudo-faq clearfix">
                  	<h2><?php echo ucfirst($dadosFaq->pergunta); ?></h2> 
                  	<div class="resposta" >
                  	    <?php echo $dadosFaq->solucao; ?>			
              		</div>
              		
           <?php 
           }
        }
        ?>
    	<div class="fio"></div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>
