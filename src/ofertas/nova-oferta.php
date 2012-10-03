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
<script type="text/javascript">
var qtdeCampos = 0;
	function adicionaCampos() {
                    
                            var objPai = document.getElementById("campoPai");
                            
                            //Criando o elemento DIV;
                            
                            var objFilho = document.createElement("div");
                            
                            //Definindo atributos ao objFilho:
                            
                            objFilho.setAttribute("id","filho"+qtdeCampos);
                            
                            
                            
                            //Inserindo o elemento no pai:
                            
                            objPai.appendChild(objFilho);
                            
                            //Escrevendo algo no filho recém-criado:

                            
                            document.getElementById("filho"+qtdeCampos).innerHTML = "<input type='file' name='imagem[]' id='campo"+qtdeCampos+"' > <input type='button' onclick='removerCampo("+qtdeCampos+")' class='button' value='Remover este campo'>";
                            qtdeCampos++;
                    
                    }
                    
                    
                    function removerCampo(id) {
                    
                            
                            var objPai = document.getElementById("campoPai");
                            
                            var objFilho = document.getElementById("filho"+id);
                            
                            
                            
                            //Removendo o DIV com id específico do nó-pai:
                            
                            var removido = objPai.removeChild(objFilho);
                    
                    }
</script>
