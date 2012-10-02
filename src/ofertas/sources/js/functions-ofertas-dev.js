/* 28/09/2012  */
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
                    
function confirmaRemocao()
    {
        var decisao = confirm('Deseja realmente remover este ciclo de ofertas??');
        if(decisao)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function imagens(id)
    {
        jQuery('.imagens_'+id).toggle('slow');
    }