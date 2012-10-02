<?php
include_once 'core/ofertas-core.php';

$Ofertas = new Ofertas();
$Ofertas->listaOfertasAdmin();

if( $dadosOfertas = $Ofertas->obterOfertas() )
{?>

<h3>Listando ciclos de ofertas já cadastrados</h3>
<br />
    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
            <thead>
                <tr>
                    <th>
                        Informações
                    </th>
                    <th>
                        Mês
                    </th>
                    <th>
                        Ciclo
                    </th>
                    <th>
                        Ações
                    </th>
                 </tr>
            </thead>
            <tbody>
                <?php 
                foreach($dadosOfertas as $dadosOfertas)
                {
                ?>
                <tr>
                    <td>
                        <?php if($dadosOfertas->ativa == 1) echo '<font color="green">Ciclo de ofertas atual</font>' ?>
                    </td>
                    <td>
                        <?php echo $dadosOfertas->mes ; ?>
                    </td>
                    <td>
                        <?php echo $dadosOfertas->ciclo ; ?>
                    </td>
                    <td>
                        <a href="?page=ofertas/ofertas.php&acao=ativar&id_ativar=<?php echo (int)$dadosOfertas->id; ?>">Definir como oferta atual</a> |
                    	<a href="javascript:;" onclick="imagens(<?php echo (int)$dadosOfertas->id; ?>)">Imagens</a> |
                        <a href="?page=ofertas/ofertas.php&acao=remover&id_oferta=<?php echo (int)$dadosOfertas->id; ?>" onclick="return confirmaRemocao();">Remover</a>
                    </td>
                 </tr>
                 <tr class="imagens_<?php echo (int)$dadosOfertas->id; ?>" style="display: none; background: #ded;">
                    <td colspan="4">
                    <?php
                            $dadosImagens = $Ofertas->obterImagens($dadosOfertas->id);
                            
                            if($dadosImagens)
                            {
                                echo "Imagens cadastradas para este ciclo de ofertas<br /><br />";
                                foreach($dadosImagens as $dadosImagens)
                                {?>
                                        <a rel="example_group" title="<?php echo $dadosImagens->imagem; ?>" href="../wp-content/uploads/ofertas/<?php echo $dadosImagens->imagem; ?>">
                                            <?php echo $dadosImagens->imagem; ?>
                                        </a>
                                         || 
                                <?php    
                                }
                            }
                            else
                            {
                                  echo "Nenhuma imagem cadastrada até o momento";
                            }
                 }
                 ?>
                 <br />
                 </td>
                </tr> 
            </tbody>
        </table>
<?php    
}
else 
{
    echo "<h3>No momento não há ofertas cadastradas</h3>";	
}
?>
<script type="text/javascript" src="../wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    
<link rel="stylesheet" type="text/css" href="../wp-content/plugins/ofertas/sources/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    function imagens(id)
    {
        jQuery('.imagens_'+id).toggle('slow');
    }
    
    jQuery(document).ready(function() {
        jQuery("a[rel=example_group]").fancybox({
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'titlePosition'     : 'over',
            'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
        });
    });
</script>