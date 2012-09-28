<?php

include_once 'Controllers/ParceirosController.php';

$cabecalho = '<h3>Bem vindo(a) ao cadastro de parceiros, forneça os dados abaixo.</h3>';
$botao = 'Gravar';
if(!empty($_GET['idParceiro']) && is_numeric($_GET['idParceiro']))
{
    $cabecalho = '<h3>Alterando Convênio com ID '.(int)$_GET['idParceiro'].'</h3>';
    $botao = 'Gravar alterações';
}
$idParceiro = isset($_GET['idParceiro']) ? (int)$_GET['idParceiro'] : '' ;

$Parceiro = new Parceiros();

$dadosParceiro = $Parceiro->detalheParceiro($idParceiro);

$imagem = '<input type="file" name="imagem" />';

if($dadosParceiro)
{
	if(file_exists('../wp-content/uploads/parceiros/'.$dadosParceiro->imagem))
	{
		$imagem = 'Imagem atual<br />';
		$imagem .= '<img src="../wp-content/uploads/parceiros/'.$dadosParceiro->imagem.'" width="256" />';
		$imagem .= '<br />Para alterar utilize a opção abaixo<br />';
		$imagem .= '<input type="file" name="imagem" />';	
	}
}

if(isset($_POST['nome']))
{
    $dadosParceiro->nome = addslashes(isset($_POST['nome']) ? $_POST['nome'] : '');
    $dadosParceiro->url = addslashes(isset($_POST['url']) ? $_POST['url'] : '');
    $dadosParceiro->nomeImagem = @$_FILES['imagem']['name'];
    $dadosParceiro->tmp_name = @$_FILES['imagem']['tmp_name'];
    $dadosParceiro->idParceiro = addslashes(isset($_POST['idParceiro']) ? $_POST['idParceiro'] : '');
    
    if( $Parceiro->verificaExistenciaParceiro($dadosParceiro) )
    {
        echo "<meta http-equiv='refresh' content='1; ?page=Parceiros/Parceiros.php' ><div class='update-nag' style='background: green; color: white; font-size: 16px;'>Dados do convênio gravados com sucesso!</div>";
    }
    else
    {
        echo "<div class='update-nag' style='background: orange; font-size: 16px;'>Não foi possível salvar os dados do convênio, por favor preencha todos os campos</div>";
    }
}
?>
<br />

<form action="" method="post" enctype="multipart/form-data">
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
                        <input type="hidden" name="idParceiro" value="<?php echo $idParceiro; ?>" />
                        Nome<br />
                        <input type="text" name="nome" maxlength="255" value="<?php echo @$dadosParceiro->nome; ?>" style="width: 90%"/>
                        <br /><br />
                       
                        URL<br />
                        <input type="text" name="url" maxlength="255" value="<?php echo @$dadosParceiro->url; ?>" style="width: 90%"/>
                        <br /><br />
                        
                        Imagem<br />
                        <?php echo $imagem; ?>
                        
                        <br /><br />
                        <input type="submit" value="<?php echo @$botao; ?>" class="button-primary"/>
                        <br />
                    </td>
               </tr>
            </tbody>
         </table>
</form>