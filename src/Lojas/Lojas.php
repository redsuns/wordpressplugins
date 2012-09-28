<?php

include_once 'Controller/LojasController.php';

$Lojas = new Lojas();

if(isset($_GET['acao']) && is_numeric($_GET['idLoja']))
{
    if($_GET['acao'] == 'remover')
    {
        $idRemover = (int)$_GET['idLoja'];
        if( $Lojas->remover($idRemover) )
        {
        ?>
            <script type="text/javascript">
                alert('Loja removida com sucesso!');
                window.location.href="?page=Lojas/Lojas.php";
            </script>
         <?php
        }
    }
}

$ordenacaoBusca->campo = 'cidade';
$ordenacaoBusca->ordem = 'asc';

if( $dadosLojas = $Lojas->obterLojas($ordenacaoBusca) )
{
?>

<h3>Listando as lojas já cadastradas</h3>
<br />

    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
            <thead>
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        Cidade
                    </th>
                    <th>
                        Endereço
                    </th>
                    <th>
                        Telefone
                    </th>
                    <th>
                        Farmácia popular
                    </th>
                    <th>
                        Ações
                    </th>
                 </tr>
            </thead>
            <tbody>
                <?php 
                foreach($dadosLojas as $dadosLojas){
                ?>
                <tr>
                    <td>
                        <?php echo $dadosLojas->nome ; ?>
                    </td>
                    <td>
                        <?php echo $dadosLojas->cidade ; ?>
                    </td>
                    <td>
                        <?php echo $dadosLojas->endereco ; ?>
                    </td>
                    <td>
                        <?php echo $dadosLojas->telefone ; ?>
                    </td>
                    <td>
                        <?php echo ucfirst($dadosLojas->farmacia_popular); ?>
                    </td>
                    <td>
                        <a href="?page=Lojas/NovaLoja.php&idLoja=<?php echo (int)$dadosLojas->id; ?>">Editar</a> |
                        <a href="?page=Lojas/Lojas.php&acao=remover&idLoja=<?php echo (int)$dadosLojas->id; ?>" onclick="return confirmaRemocao();">Remover</a>
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
    echo "<h3>No momento não há lojas cadastradas</h3>";	
}
?>
<script type="text/javascript">
    function confirmaRemocao()
    {
        var decisao = confirm('Deseja realmente remover esta loja??');
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
