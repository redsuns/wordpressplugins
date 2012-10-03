<?php

if(is_admin())
{
	include_once '../wp-content/plugins/ofertas/sources/libs/resize/core/class.simpleImage.php';
}
else 
{
	include_once './wp-content/plugins/ofertas/sources/libs/resize/core/class.simpleImage.php';	
}

 class Ofertas
 {
     public $name = 'Ofertas';
     
     /**
      * novaOferta method 
      * Trata os dados do post no admin
      */
     public function novaOferta()
     {
        if(isset($_POST['mes']))
        {
            $dadosOferta->mes = addslashes(isset($_POST['mes']) ? $_POST['mes'] : '');
            $dadosOferta->ciclo = addslashes(isset($_POST['ciclo']) ? $_POST['ciclo'] : '');
            
            if( $this->verificaExistenciaOferta($dadosOferta) )
                echo "<meta http-equiv='refresh' content='1; ?page=ofertas/ofertas.php' ><div class='update-nag' style='background: green; color: white; font-size: 16px;'>Dados da oferta gravados com sucesso!</div>";
            else
                echo "<div class='update-nag' style='background: orange; font-size: 16px;'>Não foi possível salvar os dados da oferta, por favor preencha todos os campos</div>";        
        }
     }
     
     /**
      * listaOfertas method
      * Trata as ações de visualização de ofertas no admin
      */
     public function listaOfertasAdmin()
     {
        if( isset( $_GET['acao'] ) )
        {
            if( $_GET['acao'] == 'remover' )
            {
                $idRemover = (int)$_GET['id_oferta'];
                if( $this->remover($idRemover) )
                {?>
                    <script type="text/javascript">
                        alert( 'Oferta removida com sucesso!' );
                        window.location.href="?page=ofertas/ofertas.php";
                    </script>
                <?php
                }
            }
            else if( $_GET['acao'] == 'ativar' )
            {
                $idAtivar = $_GET['id_ativar'];
                
                if( $this->ativarOferta( $idAtivar ) )
                {?>
                    <script type="text/javascript">
                        alert( 'Oferta definida como atual!' );
                        window.location.href="?page=ofertas/ofertas.php";
                    </script>
                <?php 
                }
            }
        }
     }
     
     /**
      * obterOfertas method
      * Retorna os dados das ofertas cadastradas
      * @param $idBusca (opcional) - Caso seja uma oferta em específico
      * deve ser chamado passando o id da mesma
      * Caso esteja no site deve ser passado o parametro $ativa como 1 para que 
      * liste somente a oferta ativa
      */
     public function obterOfertas($idBusca = null, $ativa = null)
     {
         $where = '';
         if($idBusca)
         {
             $where = ' where id='.$idBusca.' ';
         }
         if($ativa)
         {
             $where = ' where ativa=1';
         }
         $dadosOfertas = array();
         $obterOfertas = "select * from ofertas $where order by data_cadastro desc";
         $obterOfertas = mysql_query($obterOfertas) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaOfertas = mysql_fetch_object($obterOfertas))
             {
                 $dadosOfertas[] = $filaOfertas;
             }
         }
         return $dadosOfertas;
     }
     
     public function obterPrimeiraImagem($idOferta)
     {
         $nomeImagem = '';
         $obterImagens = "select * from imagens_ofertas where id_oferta=$idOferta order by id asc limit 0,1";
         $obterImagens = mysql_query($obterImagens) or die('Erro: '.mysql_error());
         if(mysql_affected_rows())
         {
             $dadosImagem = mysql_fetch_object($obterImagens);
             $nomeImagem = $dadosImagem->imagem;
         }
         return $nomeImagem;
     }
     
     /**
      * listarImagens method
      * Retorna os dados das imagens de uma determinada oferta
      */
     public function obterImagens($idOferta)
     {
         $dadosImagens = array();
         $obterImagens = "select * from imagens_ofertas where id_oferta=$idOferta";
         $obterImagens = mysql_query($obterImagens) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaImagens = mysql_fetch_object($obterImagens))
             {
                 $dadosImagens[] = $filaImagens;
             }
         }
         return $dadosImagens;
     }
   
     
     public function verificaExistenciaOferta($dadosOferta)
     {
         if($dadosOferta->mes)
         {
             $where = '';
             if($dadosOferta->ciclo)
             {
                 $where = " and ciclo='$dadosOferta->ciclo'";
             }
             $verificaOfertas = "select * from ofertas where mes='$dadosOferta->mes' $where";
             $verificaOfertas = mysql_query($verificaOfertas) or die('Erro: '.mysql_error());
             
             if(!mysql_affected_rows() && empty($dadosOferta->idOferta))
             {
                  if( $this->salvar($dadosOferta) )
                  {
                      return true;
                  }  
             }
             else 
             {
                  if( $this->editar($dadosOferta) )
                  {
                      return true;
                  } 
             }    
         }
     } 
     
     
     private function salvar($dadosOferta)
     {
         $data = @date('Y-m-d H:i:s');
         $gravarDadosOferta = "insert into ofertas set
                                mes='$dadosOferta->mes',
                                ciclo='$dadosOferta->ciclo',
                                ativa=0,
                                data_cadastro='$data'
                                
         ";
         $gravarDadosOferta = mysql_query($gravarDadosOferta) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             $dadosOferta->id = $this->getLastIDOferta();
             $this->uploadImagens($dadosOferta);
             return true;
         }
         
     }
     
     private function editar($dadosOferta)
     {
         $data = @date('Y-m-d H:i:s');
         $atualizaOferta = "update ofertas set 
                            mes='$dadosOferta->mes',
                            ciclo='$dadosOferta->ciclo',
                            ativa=0,
                            data_cadastro='$data'
                            where id='$dadosOferta->id'    
         ";
         
         $atualizaOferta = mysql_query($atualizaOferta) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }

         $this->uploadImagens($dadosOferta);
         
		 return true;
         
     }
     
     public function remover($idRemover)
     {
         $this->removeImagem($idRemover);
         
         $removeOferta = "delete from ofertas where id='$idRemover'";
         $removeOferta = mysql_query($removeOferta) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
     
     public function getLastIDOferta()
     {
         $buscaLastID = "select id from ofertas order by id desc limit 0,1";
         $buscaLastID = mysql_query($buscaLastID) or die('Erro: '.mysql_error());
         $lastID = mysql_fetch_object($buscaLastID);
         $lastID = $lastID->id;
         return $lastID;
     }
     
	 private function uploadImagens($dadosOferta)
	 {
	 	$Resize = new SimpleImage();
		
	    $pathToUpload = '../wp-content/uploads/ofertas/'; 
		$pathToUploadThumbs = '../wp-content/uploads/ofertas/thumbs/'; 
        
        if( !is_dir($pathToUpload) ) @mkdir($pathToUpload);
       	if( !is_dir($pathToUploadThumbs)) @mkdir($pathToUploadThumbs);
		
	 	if($_FILES)
        {
            for( $cont = 0; $cont < count($_FILES['imagem']['name']); $cont++ )
            {
               if(eregi('image',$_FILES['imagem']['type'][$cont]))
               {
                   if(move_uploaded_file($_FILES['imagem']['tmp_name'][$cont], $pathToUpload.$_FILES['imagem']['name'][$cont]))
                   {
                   	   // gerando miniaturas
                   	   $Resize->load($pathToUpload.$_FILES['imagem']['name'][$cont]);
                   	   $Resize->resizeToWidth('150');
   					   $Resize->save($pathToUploadThumbs.$_FILES['imagem']['name'][$cont]);
                   	   
                       $dadosImagemSalvar->nome = $_FILES['imagem']['name'][$cont];
                       $dadosImagemSalvar->id = $dadosOferta->id;
                       $this->salvaDadosImagem($dadosImagemSalvar);
                   }
               }
            }
        }
	 }
     
     private function salvaDadosImagem($dadosImagem)
     {
         $salvaDadosImagem = "insert into imagens_ofertas set imagem='$dadosImagem->nome', id_oferta='$dadosImagem->id'";
         $salvaDadosImagem = mysql_query($salvaDadosImagem) or die('Erro: '.mysql_error());
     }
	 
	 private function removeImagem($idRemover)
	 {
	    $dadosImagens = $this->obterOfertas($idRemover);
        
        foreach($dadosImagens as $dadosImagens)
        {
            @unlink('../wp-content/uploads/ofertas/'.$dadosImagens->imagem);
			@unlink('../wp-content/uploads/ofertas/thumbs/'.$dadosImagens->imagem);    
        } 
	 	
	 }
     
     /**
      * ativarOferta method
      * Ativa uma oferta somente para ser a exibida no ite
      */
     public function ativarOferta($idAtivar)
     {
         $desmarcaOfertas = "update ofertas set ativa=0";
         @mysql_query($desmarcaOfertas);
         
         $defineOfertaAtual = "update ofertas set ativa=1 where id=$idAtivar";
         $defineOfertaAtual = mysql_query($defineOfertaAtual) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
     }
	 
 }
?>