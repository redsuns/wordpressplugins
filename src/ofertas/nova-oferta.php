<?php
include_once 'core/ofertas-core.php';

$Oferta = new Ofertas();
$Oferta->novaOferta();

?>

<br />
<form action="" method="post" enctype="multipart/form-data">
    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
            <thead>
                <tr>
                    <th>
                        <h3>Bem vindo(a) ao cadastro de ofertas, forneça os dados abaixo.</h3>
                    </th>
                 </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Mês
                        <br />
                        <input type="text" name="mes" maxlength="255" style="width: 90%"/>
                        <br />
                        <br />
                        Ciclo (opcional)
                        <br />
                        <input type="text" name="ciclo" maxlength="255" style="width: 90%"/>
                        <br /><br />
                        <b>Imagens</b>
                        <br />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <br />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <input type="file" name="imagem[]" />
                        <br />
                        <br />
                        <div class="campoPai" id="campoPai"></div>
                        <input type="button" class="button" value="Mais campos" onclick="adicionaCampos();" />
                        <br />
                        <br />
                        <input type="submit" value="Gravar dados" class="button-primary"/>
                        <br />
                    </td>
               </tr>
            </tbody>
         </table>
</form>