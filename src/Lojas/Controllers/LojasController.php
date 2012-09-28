<?php
 class Lojas
 {
     public $name = 'Lojas';
     
     
     function obterLojas($ordenacao)
     {
         $dadosLojas = array();
         $obterLojas = "select * from lojas order by $ordenacao->campo $ordenacao->ordem";
         $obterLojas = mysql_query($obterLojas) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaLojas = mysql_fetch_object($obterLojas))
             {
                 $dadosLojas[] = $filaLojas;
             }
         }
         return $dadosLojas;
     }
     
     
     
     function detalheLoja($idLoja)
     {
         $dadosLoja = '';
         $buscaDadosLoja = "select * from lojas where id='$idLoja'";
         $buscaDadosLoja = mysql_query($buscaDadosLoja) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             $dadosLoja = mysql_fetch_object($buscaDadosLoja);
         }
         return $dadosLoja;
     }
     
     function obterCidades()
     {
         $listaCidades = array();
         
         $buscaCidades = "select distinct cidade as nome from lojas order by cidade asc";
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
     
     function obterLojasPorCidade($nomeCidade)
     {
         $listaLojas = array();
         
         $buscaLojas = "select * from lojas where cidade='$nomeCidade' order by nome asc";
         $buscaLojas = mysql_query($buscaLojas) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaLojas = mysql_fetch_object($buscaLojas))
             {
                 $listaLojas[] = $filaLojas;
             }
         }
         return $listaLojas;
     }
     
     
     function verificaExistenciaLoja($dadosLoja)
     {
         if($dadosLoja->nome && $dadosLoja->endereco)
         {
            $verificaloja = "select * from lojas where nome='$dadosLoja->nome'";
         
             $verificaloja = mysql_query($verificaloja) or die('Erro: '.mysql_error());
             
             if(!mysql_affected_rows() && empty($dadosLoja->idLoja))
             {
                  if( $this->salvar($dadosLoja) )
                  {
                      return true;
                  }  
             }
             else 
             {
                  if( $this->editar($dadosLoja) )
                  {
                      return true;
                  } 
             }    
         }
     } 
     
     
     private function salvar($dadosLoja)
     {
         $gravarDadosLoja = "insert into lojas set
                                nome='$dadosLoja->nome',
                                endereco='$dadosLoja->endereco',
                                telefone='$dadosLoja->telefone',
                                cidade='$dadosLoja->cidade',
                                farmacia_popular='$dadosLoja->farmaciaPopular'
         ";
         $gravarDadosLoja = mysql_query($gravarDadosLoja) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
     
     
     private function editar($dadosLoja)
     {
         $atualizaLoja = "update lojas set 
                            nome='$dadosLoja->nome',
                            endereco='$dadosLoja->endereco',
                            telefone='$dadosLoja->telefone',
                            cidade='$dadosLoja->cidade',
                            farmacia_popular='$dadosLoja->farmaciaPopular'
                            where id='$dadosLoja->id'    
         ";
         $atualizaLoja = mysql_query($atualizaLoja) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
         
     }
     
     function remover($idRemover)
     {
         $removeLoja = "delete from lojas where id='$idRemover'";
         $removeLoja = mysql_query($removeLoja) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
 }
?>