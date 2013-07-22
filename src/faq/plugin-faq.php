<?php
/*
 * Plugin Name: Perguntas e respostas
 * Description: O plugin Perguntas e respostas facilita o cadastro de perguntas frequentes em seu Blog/Site
 * Author: Redsuns Design e Tecnologia Web
 * Author URI: http://www.redsuns.com.br
 * Date: 2013-07-22
 * Version: 2.0
 */


/**
 * @since 2.0
 */
function codex_custom_init()
{
    $args = array('public' => true, 'label' => 'Faq');
    register_post_type('faq', $args);
}

add_action('init', 'codex_custom_init');


/**
 * @#since 2.0
 */
function faq()
{
    show_faq();
}

add_shortcode('faq', 'faq');


/**
 * @since 2.0
 */
function show_faq()
{
    $faqs = get_posts(array('post_type' => 'faq', 'orderby' => 'post_date', 'order' => 'ASC'));

    if (!empty($faqs)) :
        ?>
        <div class="faq">
            <ul>
                <?php foreach ($faqs as $faq) : ?>
                    <li>
                        <div class="content" id="<?php echo $faq->ID; ?>">
                            <a href="#" class="content-link" id="<?php echo $faq->ID; ?>"><h4><?php echo $faq->post_title; ?></h4></a>
                            <div class="answer" id="content_<?php echo $faq->ID; ?>" style="display:none;">
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $faq->post_content; ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php else : ?>
        <h4>Não há perguntas e respostas cadastradas</h4>
    <?php endif; ?>
<?php }
