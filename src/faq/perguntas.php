<?php

include_once 'core/faq-core.php';

$Faq = new Faq();

if(isset($_GET['acao']) && is_numeric($_GET['id_faq']))
{
    if($_GET['acao'] == 'remover')
    {
        $idRemover = (int)$_GET['id_faq'];
        if( $Faq->remover($idRemover) )
        {
        ?>
            <script type="text/javascript">
                alert('Pergunta removida com sucesso!');
                window.location.href="?page=faq/perguntas.php";
            </script>
         <?php
        }
    }
}

$ordenacaoBusca->campo = 'id';
$ordenacaoBusca->ordem = 'desc';

if( $dadosFaq = $Faq->obterListaFaq($ordenacaoBusca) )
{
?>

<h3>Listando as Perguntas e respostas (FAQ) já cadastradas</h3>
<br />

    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Pergunta
                    </th>
                    <th>
                        Solução
                    </th>
                    <th>
                        Ações
                    </th>
                 </tr>
            </thead>
            <tbody>
                <?php 
                foreach($dadosFaq as $dadosFaq){
                    
                    $imagem = '../wp-content/plugins/faq/sources/images/no-image.png';
                    if( $dadosFaq->imagem != '' )
                    {
                        $imagem = 'wp-content/uploads/faq/'.$dadosFaq->imagem;
                    }
                ?>
                <tr>
                    <td>
                        <?php echo (int)$dadosFaq->id ; ?>
                    </td>
                    <td>
                        <?php echo $dadosFaq->pergunta ; ?>
                    </td>
                    <td>
                        <?php echo $dadosFaq->solucao ; ?>
                    </td>
                    <!--<td>
                        <img src="<?php echo $imagem ; ?>" width="64" />
                    </td> -->
                    <td>
                        <a href="?page=faq/nova-pergunta.php&id_faq=<?php echo (int)$dadosFaq->id; ?>">Editar</a> |
                        <a href="?page=faq/perguntas.php&acao=remover&id_faq=<?php echo (int)$dadosFaq->id; ?>" onclick="return confirmaRemocao();">Remover</a>
                    </td>
                 </tr>
                 <?php
                 }
                 ?>
            </tbody>
        </table>
<?php    
}
else 
{
    echo "<h3>No momento não há Perguntas e respostas (FAQ) cadastradas</h3>";	
}
?>
<script type="text/javascript">
    function confirmaRemocao()
    {
        var decisao = confirm('Deseja realmente remover esta pergunta??');
        if(decisao)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
