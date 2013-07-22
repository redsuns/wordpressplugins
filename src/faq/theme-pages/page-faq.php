<?php
/**
 * Template Name: Faq
 * Description: Aqui será montado o layout para apresentação das perguntas e respostas
 * frequentes
 * @since 1.0
 * 
 */

get_header(); ?>

<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumb breadcrumbs woo-breadcrumbs">
                <?php woocommerce_breadcrumb() ?>
            </div>
        </div>

        <div class="span12">
            <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>

                <?php the_content(); ?>
                <br />
                <?php do_shortcode('[faq]'); ?>
                <br/><br/>

            <?php endwhile; ?>
        </div>
    </div>
    <div class="row">

        <div class="span12">
            <div class="facebook hidden-phone">
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/Athina-Jewelry-Shop/436257459788960" 
                     data-width="1170" data-height="" data-show-faces="true" data-stream="false" data-border-color="#e4dece" data-header="false">
                </div>				
            </div>
        </div>	        
    </div>

    <br/>
</div>


<script>
    jQ = jQuery.noConflict();
    jQ(".content-link").click(function() {
        toShow = jQ(this).attr("id");
        jQ(".answer").slideUp();
        jQ("#content_" + toShow).slideDown();
        return false;
    });
</script>

<?php get_footer();
