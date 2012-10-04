<?php
 class Faq
 {
     public $name = 'Faq';
     
     
     function obterListaFaq($ordenacao)
     {
         $dadosFaq = array();
         $obterFaq = "select * from rs_faq order by $ordenacao->campo $ordenacao->ordem";
         $obterFaq = mysql_query($obterFaq) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             while($filaFaq = mysql_fetch_object($obterFaq))
             {
                 $dadosFaq[] = $filaFaq;
             }
         }
         return $dadosFaq;
     }
     
     
     
     function detalhesFaq($idFaq)
     {
         $dadosFaq = '';
         $buscaDadosFaq = "select * from rs_faq where id='$idFaq'";
         $buscaDadosFaq = mysql_query($buscaDadosFaq) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             $dadosFaq = mysql_fetch_object($buscaDadosFaq);
         }
         return $dadosFaq;
     }
     
 
     function verificaExistenciaFaq($dadosFaq)
     {
         if($dadosFaq->pergunta && $dadosFaq->solucao)
         {
             $verificaFaq = "select * from rs_faq where pergunta='$dadosFaq->pergunta'";
         
             $verificaFaq = mysql_query($verificaFaq) or die('Erro: '.mysql_error());
             
             if(!mysql_affected_rows() && empty($dadosFaq->idFaq))
             {
                  if( $this->salvar($dadosFaq) )
                  {
                      return true;
                  }  
             }
             else 
             {
                  if( $this->editar($dadosFaq) )
                  {
                      return true;
                  } 
             }    
         }
     } 
     
     
     private function salvar($dadosFaq)
     {
         $gravarDadosFaq = "insert into rs_faq set
                                pergunta='$dadosFaq->pergunta',
                                solucao='$dadosFaq->solucao'
         ";
         $gravarDadosFaq = mysql_query($gravarDadosFaq) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
     
     
     private function editar($dadosFaq)
     {
         $atualizaFaq = "update rs_faq set 
                            pergunta='$dadosFaq->pergunta',
                            solucao='$dadosFaq->solucao' 
                            where id='$dadosFaq->id'    
         ";
         $atualizaFaq = mysql_query($atualizaFaq) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
         
     }
     
     function remover($idRemover)
     {
         $removeFaq = "delete from rs_faq where id='$idRemover'";
         $removeFaq = mysql_query($removeFaq) or die('Erro: '.mysql_error());
         
         if(mysql_affected_rows())
         {
             return true;
         }
         
     }
 }
?>