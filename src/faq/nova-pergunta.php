<?php
/**
 * @since 1.0
 */

global $current_user;

$cabecalho = '<h3>Bem vindo(a) ao cadastro de perguntas e respostas.</h3>';
$botao = 'Gravar';

if (!empty($_GET['id_faq']) && is_numeric($_GET['id_faq'])) {
    $cabecalho = '<h3>Alterando Pergunta com ID ' . (int) $_GET['id_faq'] . '</h3>';
    $botao = 'Gravar alterações';
}

$id_faq = isset($_GET['id_faq']) ? (int) $_GET['id_faq'] : '';
$dados_faq = null; 

if ( !empty($id_faq) ) {
    $dados_faq = get_post($id_faq);
}

if (isset($_POST['pergunta']) && !empty($_POST['pergunta']) && isset($_POST['solucao']) && !empty($_POST['pergunta'])) {

    $post = array(
        'menu_order' => '0',
        'comment_status' => 'closed',
        'ping_status' => 'open',
        'post_author' => $current_user->ID,
        'post_content' => sanitize_text_field($_POST['solucao']),
        'post_excerpt' => substr(sanitize_text_field($_POST['solucao']), 0, 200),
        'post_name' => sanitize_title($_POST['pergunta']),
        'post_status' => 'publish',
        'post_title' => $_POST['pergunta'],
        'post_type' => 'faq',
    );

    if ( isset($_POST['id_faq']) && !empty($_POST['id_faq']) ) {
        $post['ID'] = (int) $_POST['id_faq'];
    }
    
    if ( wp_update_post($post) ) {
        echo '<script>alert("Faq atualizado com sucesso!"); window.location.href="?page=faq/nova-pergunta.php";</script>';
    }
    if (wp_insert_post($post)) {
        echo '<script>alert("Faq cadastrado com sucesso!"); window.location.href="?page=faq/nova-pergunta.php";</script>';
    }
    
}
?>
<br />

<form action="" method="post">
    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
        <thead>
            <tr>
                <th>
                    <?php echo $cabecalho; ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="hidden" name="id_faq" value="<?php echo @$dados_faq->ID; ?>" />
                    Pergunta<br />
                    <input type="text" name="pergunta" maxlength="255" value="<?php echo @$dados_faq->post_title; ?>" style="width: 90%"/>
                    <br /><br />

                    Solução<br />
                    <textarea style="width: 90%; height: 100px;" name="solucao"><?php echo @$dados_faq->post_content; ?></textarea>
                    <br /><br />

                    <input type="submit" value="<?php echo @$botao; ?>" class="button button-primary"/>
                    <br />
                </td>
            </tr>
        </tbody>
    </table>
</form>