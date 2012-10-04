<?php

include_once 'core/lojas-core.php';

$cabecalho = '<h3>Bem vindo(a) ao cadastro de lojas, forneça os dados abaixo.</h3>';
$botao = 'Gravar';
if(!empty($_GET['idLoja']) && is_numeric($_GET['idLoja']))
{
    $cabecalho = '<h3>Alterando loja com ID '.(int)$_GET['idLoja'].'</h3>';
    $botao = 'Gravar alterações';
}
$idLoja = isset($_GET['idLoja']) ? (int)$_GET['idLoja'] : '' ;

$Loja = new Lojas();

$dadosLoja = $Loja->detalheLoja($idLoja);

if(isset($_POST['nome']) && isset($_POST['cidade']))
{
    $dadosLoja->nome = addslashes(isset($_POST['nome']) ? $_POST['nome'] : '');
    $dadosLoja->endereco = addslashes(isset($_POST['endereco']) ? $_POST['endereco'] : '');
    $dadosLoja->telefone = addslashes(isset($_POST['telefone']) ? $_POST['telefone'] : '');
    $dadosLoja->cidade = addslashes(isset($_POST['cidade']) ? $_POST['cidade'] : '');
    $dadosLoja->farmaciaPopular = addslashes(isset($_POST['farmaciaPopular']) ? $_POST['farmaciaPopular'] : '');
    $dadosLoja->idLoja = addslashes(isset($_POST['idLoja']) ? $_POST['idLoja'] : '');
    
    if( $Loja->verificaExistenciaLoja($dadosLoja) )
    {
        echo "<meta http-equiv='refresh' content='1; ?page=lojas/lojas.php' ><div class='update-nag' style='background: green; color: white; font-size: 16px;'>Dados da loja gravados com sucesso!</div>";
    }
    else
    {
        echo "<div class='update-nag' style='background: orange; font-size: 16px;'>Não foi possível salvar os dados da loja, por favor preencha todos os campos</div>";
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
                        <input type="hidden" name="idLoja" value="<?php echo $idLoja; ?>" />
                        Bairro<br />
                        <input type="text" name="nome" maxlength="255" value="<?php echo @$dadosLoja->nome; ?>" style="width: 90%"/>
                        <br /><br />
                       
                        Endereço<br />
                        <input type="text" name="endereco" maxlength="255" value="<?php echo @$dadosLoja->endereco; ?>" style="width: 90%"/>
                        <br /><br />
                        
                        Cidade<br />
                        <input type="text" name="cidade" maxlength="255" value="<?php echo @$dadosLoja->cidade; ?>" style="width: 90%"/>
                        <br /><br />
                        
                        Telefone<br />
                        <input type="text" name="telefone" maxlength="255" value="<?php echo @$dadosLoja->telefone; ?>" style="width: 90%"/>
                        <br /><br />
                        
                        Possui convênio com farmácia popular?<br />
                        <select name="farmaciaPopular">
                            <option value="sim"
                                <?php 
                                    if($dadosLoja->farmaciaPopular == 'sim')
                                    echo 'selected';
                                ?>
                            >Sim</option>
                            <option value="nao"
                                <?php 
                                    if($dadosLoja->farmaciaPopular == 'nao')
                                    echo 'selected';
                                ?>
                            >Não</option>
                        </select>
                        <br /><br />
                        <input type="submit" value="<?php echo @$botao; ?>" class="button-primary"/>
                        <br />
                    </td>
               </tr>
            </tbody>
         </table>
</form>
