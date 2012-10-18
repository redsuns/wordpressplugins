<?php
 class Parceiros
 {
     public $name = 'Parceiros';
     
     
     public function obterParceiros()
     {
         $dadosParceiros = array();
         $obterParceiros = "select * from parceiros order by nome asc";
         $obterParceiros = mysql_query($obterParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaParceiros = mysql_fetch_object($obterParceiros))
             {
                 $dadosParceiros[] = $filaParceiros;
             }
         }
         return $dadosParceiros;
     }
     
     
     
     public function detalheParceiro($idParceiro)
     {
         $dadosParceiros = '';
         $buscaDadosParceiros = "select * from parceiros where id='$idParceiro'";
         $buscaDadosParceiros = mysql_query($buscaDadosParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             $dadosParceiros = mysql_fetch_object($buscaDadosParceiros);
         }
         return $dadosParceiros;
     }
     
     
     public function obterCidades()
     {
         $listaCidades = array();
         
         $buscaCidades = "select distinct cidade as nome from parceiros order by cidade asc";
         $buscaCidades =mysql_query($buscaCidades) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaCidades = mysql_fetch_object($buscaCidades))
             {
                 $listaCidades[] = $filaCidades;
             }
         }
         return $listaCidades;
     }
     
     
     public function obterParceirosPorCidade($nomeCidade)
     {
         $listaParceiros = array();
         
         $buscaParceiros = "select * from parceiros where cidade='$nomeCidade' order by nome asc";
         $buscaParceiros = mysql_query($buscaParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaParceiros = mysql_fetch_object($buscaParceiros))
             {
                 $listaParceiros[] = $filaParceiros;
             }
         }
         return $listaParceiros;
     }
     
     
     public function verificaExistenciaParceiro($dadosParceiros)
     {
         if($dadosParceiros->nome)
         {
             $verificaParceiros = "select * from parceiros where nome='$dadosParceiros->nome'";
             $verificaParceiros = mysql_query($verificaParceiros) or die('Erro: '.mysql_error());
             
             if(!mysql_affected_rows() && empty($dadosParceiros->idParceiros))
             {
                  if( $this->salvar($dadosParceiros) )
                  {
                      return true;
                  }  
             }
             else 
             {
                  if( $this->editar($dadosParceiros) )
                  {
                      return true;
                  } 
             }    
         }
     } 
     
     
     private function salvar($dadosParceiros)
     {
     	if( !eregi('http://', $dadosParceiros->url))
		{
			$dadosParceiros->url = 'http://'.$dadosParceiros->url;
		}
         $gravarDadosParceiros = "insert into parceiros set
                                nome='$dadosParceiros->nome',
                                descricao='$dadosParceiros->descricao',
                                url='$dadosParceiros->url'
         ";
         $gravarDadosParceiros = mysql_query($gravarDadosParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             $imagem->nomeImagem = $dadosParceiros->nomeImagem;
             $imagem->tmp_name = $dadosParceiros->tmp_name;
             $imagem->idParceiro = $this->getLastIDParceiro();
             $this->verificaImagem($imagem);
             return true;
         }
         
     }
     
     private function editar($dadosParceiros)
     {
     	if( !eregi('http://', $dadosParceiros->url))
		{
			$dadosParceiros->url = 'http://'.$dadosParceiros->url;
		}
         $atualizaParceiros = "update parceiros set 
                            nome='$dadosParceiros->nome',
                            descricao='$dadosParceiros->descricao',
                            url='$dadosParceiros->url'
                            where id='$dadosParceiros->id'    
         ";
         die(print_r($atualizaParceiros));
         $atualizaParceiros = mysql_query($atualizaParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
		 
		 if ( $dadosParceiros->nomeImagem ) 
		 {
		 	 $imagem->nomeImagem = $dadosParceiros->nomeImagem;
	         $imagem->tmp_name = $dadosParceiros->tmp_name;
	         $imagem->idParceiro = $dadosParceiros->id;
	         $this->verificaImagem($imagem);	
		 }
		 return true;
         
     }
     
     public function remover($idRemover)
     {
         $removeParceiros = "delete from parceiros where id='$idRemover'";
         $removeParceiros = mysql_query($removeParceiros) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
     
     public function getLastIDParceiro()
     {
         $buscaLastID = "select id from parceiros order by id desc limit 0,1";
         $buscaLastID = mysql_query($buscaLastID) or die('Erro: '.mysql_error());
         $lastID = mysql_fetch_object($buscaLastID);
         $lastID = $lastID->id;
         return $lastID;
     }
     
	 private function verificaImagem($imagem)
	 {
	 	$verificaImagemAnterior = "select imagem from parceiros where id='$imagem->idParceiro'";
		$verificaImagemAnterior = mysql_query($verificaImagemAnterior) or die('Erro: '.mysql_error());
		
		if(mysql_affected_rows())
		{
			$dadosImagem = mysql_fetch_object($verificaImagemAnterior) or die('Erro: '.mysql_error());
			$imagem->nomeImagemRemover = $dadosImagem->imagem;
			
			$this->removeImagem($imagem);
			
			$this->uploadImagem($imagem);
		}
		else 
		{
			$this->uploadImagem($imagem);	
		}
	 }
	 
	 private function removeImagem($imagem)
	 {
	 	unlink('../wp-content/uploads/parceiros/'.$imagem->nomeImagemRemover);
	 }
	 
     private function uploadImagem($imagem)
     {
         $pathToUpload = '../wp-content/uploads/parceiros/';
         if(!is_dir($pathToUpload))
         {
             @mkdir($pathToUpload);
         }
         
         if(move_uploaded_file($imagem->tmp_name, $pathToUpload.$imagem->nomeImagem))
         {
             $this->atualizaCampoImagem($imagem);
         }
         
     }
     
     private function atualizaCampoImagem($dados)
     {
         $atualizaDadosImagemParceiro = "update parceiros set imagem='$dados->nomeImagem' where id='$dados->idParceiro'";
         mysql_query($atualizaDadosImagemParceiro) or die('Erro: '.mysql_error());
     }
     
 }
?>