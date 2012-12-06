<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Farmacias-descontao
 * @since Farmacias-descontao 1.0
 */

get_header(); ?>

        <div class="meio clearfix">
        	<div class="banner clearfix">
	        	<div class="esq">
	        	</div>
	        	<div class="cont-banner">
		        	<div class="corta-imagem"></div>
		        	<div class="banner-imagem">
		        		<?php if (function_exists('vslider')) { vslider('Banner1'); }?>
		        	</div>
	        	</div>
	        	<div class="dir">
	        	</div>
	        	
        	</div>
	        <div class="conteudo-1005">
	        	<div class="titulo-ofertas">
		        	<h2>Ofertas</h2>
	        	</div>
	        	<div class="conteudo">
                <h3 align="center" class="fio-h3"><a href="<?php echo get_permalink(9); ?>">Confira as ofertas imbatíveis do nosso tablóide!</a></h3>
					<?php
						if ( file_exists('wp-content/plugins/destaque-home/sources/imagens/destaque-home.jpg') ) {
							$imagemDestaque = get_bloginfo('url').'/wp-content/plugins/destaque-home/sources/imagens/destaque-home.jpg';
						} else if ( file_exists('wp-content/plugins/destaque-home/sources/imagens/destaque-home.png') ) {
							$imagemDestaque = get_bloginfo('url').'/wp-content/plugins/destaque-home/sources/imagens/destaque-home.png';
						} else {
							$imagemDestaque = get_bloginfo('template_directory').'/img/produtos.png';
						} 
					?>
	        		<a href="<?php echo get_permalink(9); ?>"><img src="<?php echo $imagemDestaque; ?>" /></a>
	        	</div>
	        	<div class="fio"></div>
	        </div>
        </div>
        

<?php get_footer(); ?>