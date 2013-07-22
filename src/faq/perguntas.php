<?php
/**
 * @since 1.0
 */

if (isset($_GET['id_faq']) && !empty($_GET['id_faq']) && $_GET['acao'] == 'remover') {
    if (wp_delete_post($_GET['id_faq'])) {
        echo '<script>alert("Faq removido com sucesso!"); window.location.href="?page=faq/perguntas.php";</script>';
    }
}

if ($dadosFaq = get_posts(array('post_type' => 'faq'))) :  ?>

    <h3>Listando as Perguntas e respostas (FAQ) já cadastradas</h3>
    <br />

    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
        <thead>
            <tr>
                <th>Pergunta</th>
                <th>Solução</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($dadosFaq as $dadosFaq) { ?>
                <tr>
                    <td>
        <?php echo $dadosFaq->post_title; ?>
                    </td>
                    <td>
        <?php echo $dadosFaq->post_content; ?>
                    </td>
                    <td>
                        <a href="?page=faq/nova-pergunta.php&id_faq=<?php echo (int) $dadosFaq->ID; ?>">Editar</a> |
                        <a href="?page=faq/perguntas.php&acao=remover&id_faq=<?php echo (int) $dadosFaq->ID; ?>" 
                           onclick="return confirm('Deseja realmente remover este FAQ?')">Remover</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
else :
    echo "<h3>No momento não há Perguntas e respostas (FAQ) cadastradas</h3>";
        endif;
