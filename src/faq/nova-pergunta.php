<?php

include_once 'core/faq-core.php';

$cabecalho = '<h3>Bem vindo(a) ao cadastro de perguntas e respostas.</h3>';
$botao = 'Gravar';

if(!empty($_GET['id_faq']) && is_numeric($_GET['id_faq']))
{
    $cabecalho = '<h3>Alterando Pergunta com ID '.(int)$_GET['id_faq'].'</h3>';
    $botao = 'Gravar alterações';
}

$idFaq = isset($_GET['id_faq']) ? (int)$_GET['id_faq'] : '' ;

$Faq = new Faq();

$dadosFaq = $Faq->detalhesFaq($idFaq);

if(isset($_POST['solucao']) && isset($_POST['pergunta']))
{
    $dadosFaq->pergunta = addslashes(isset($_POST['pergunta']) ? $_POST['pergunta'] : '');
    $dadosFaq->solucao = addslashes(isset($_POST['solucao']) ? $_POST['solucao'] : '');
    $dadosFaq->idFaq = addslashes(isset($_POST['id_faq']) ? $_POST['id_faq'] : '');
    
    if( $Faq->verificaExistenciaFaq($dadosFaq) )
    {
        echo "<meta http-equiv='refresh' content='1; ?page=faq/perguntas.php' ><div class='update-nag' style='background: green; color: white; font-size: 16px;'>Dados do FAQ gravados com sucesso!</div>";
    }
    else
    {
        echo "<div class='update-nag' style='background: orange; font-size: 16px;'>Não foi possível salvar os dados do FAQ, por favor preencha os campos obrigatórios</div>";
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
                        <input type="hidden" name="id_faq" value="<?php echo $idFaq; ?>" />
                        Pergunta<br />
                        <input type="text" name="pergunta" maxlength="255" value="<?php echo @$dadosFaq->pergunta; ?>" style="width: 90%"/>
                        <br /><br />
                       
                        Solução<br />
                        <textarea style="width: 90%; height: 100px;" name="solucao"><?php echo @$dadosFaq->solucao; ?></textarea>
                        <br /><br />
                        
                        <input type="submit" value="<?php echo @$botao; ?>" class="button-primary"/>
                        <br />
                    </td>
               </tr>
            </tbody>
         </table>
</form>
