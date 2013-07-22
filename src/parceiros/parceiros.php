<?php

include_once 'core/parceiros-core.php';

$Parceiros = new Parceiros();

if(isset($_GET['acao']) && is_numeric($_GET['id_parceiro']))
{
    if($_GET['acao'] == 'remover')
    {
        $idRemover = (int)$_GET['id_parceiro'];
        if( $Parceiros->remover($idRemover) )
        {
        ?>
            <script type="text/javascript">
                alert('Parceiro removido com sucesso!');
                window.location.href="?page=parceiros/parceiros.php";
            </script>
         <?php
        }
    }
}
 
 
if( $dadosParceiros = $Parceiros->obterParceiros() )
{
?>

<h3>Listando os parceiros já cadastrados</h3>
<br />

    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
            <thead>
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        URL
                    </th>
                    <th>
                        Descrição
                    </th>
                    <th>
                        Imagem
                    </th>
                    <th>
                        Ações
                    </th>
                 </tr>
            </thead>
            <tbody>
                <?php 
                foreach($dadosParceiros as $dadosParceiros)
                {
                	if($dadosParceiros->imagem != '' && file_exists('../wp-content/uploads/parceiros/'.$dadosParceiros->imagem))
				    {
				        $imagem = '../wp-content/uploads/parceiros/'.$dadosParceiros->imagem;
				    }
				    else
				    {
				        $imagem = '../wp-content/plugins/parceiros/sources/images/NoImage.png';
				    }
                ?>
                <tr>
                    <td>
                        <?php echo $dadosParceiros->nome ; ?>
                    </td>
                    <td>
                        <a href="<?php echo $dadosParceiros->url ; ?>" target="_blank"><?php echo $dadosParceiros->url ; ?></a>
                    </td>
                    <td>
                        <?php echo $dadosParceiros->descricao ; ?>
                    </td>
                    <td>
                        <img src="<?php echo $imagem ; ?>" width="64" />
                    </td>
                    <td>
                        <a href="?page=parceiros/novo-parceiro.php&id_parceiro=<?php echo (int)$dadosParceiros->id; ?>">Editar</a> |
                        <a href="?page=parceiros/parceiros.php&acao=remover&id_parceiro=<?php echo (int)$dadosParceiros->id; ?>" onclick="return confirmaRemocao();">Remover</a>
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
    echo "<h3>No momento não há parceiros cadastrados</h3>";	
}
?>
<script type="text/javascript">
    function confirmaRemocao()
    {
        var decisao = confirm('Deseja realmente remover este parceiro??');
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
