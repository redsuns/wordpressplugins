<?php 

	if ( !empty($_FILES['imagem']) ) {
		if ( $_FILES['imagem']['type'] == 'image/jpeg' || $_FILES['imagem']['type'] == 'image/png' ) {
			$nameTmp = $_FILES['imagem']['tmp_name'];
			$extensao = 'jpg';
			if ( $_FILES['imagem']['type'] == 'image/png' ) {
				$extensao = 'png';
			}
			
			@unlink('../wp-content/plugins/destaque-home/sources/imagens/destaque-home.jpg');
			@unlink('../wp-content/plugins/destaque-home/sources/imagens/destaque-home.png');
			
			if ( move_uploaded_file($nameTmp, '../wp-content/plugins/destaque-home/sources/imagens/destaque-home.'.$extensao) ) {
				echo "<script type='text/javascript'> alert('Imagem cadastrada com sucesso!');window.location.href='?page=destaque-home/destaque.php';</script>";
			}
		} else {
			echo "<script type='text/javascript'> alert('Tipo de imagem inválido'); </script>";
		}
		
	}
	
	
	if ( file_exists( '../wp-content/plugins/destaque-home/sources/imagens/destaque-home.jpg' ) ) {
		$imagemAtual = '<img src="../wp-content/plugins/destaque-home/sources/imagens/destaque-home.jpg" width="600" />';
	} else if ( file_exists( '../wp-content/plugins/destaque-home/sources/imagens/destaque-home.png' ) ) {
		$imagemAtual = '<img src="../wp-content/plugins/destaque-home/sources/imagens/destaque-home.png" width="600" />';
	} else {
		$imagemAtual = 'Nenhuma imagem de destaque cadastrada';	
	}
	
?>

<h3>Realize upload da imagem a ser exibida na Home do site</h3>

<form action="" method="post" enctype="multipart/form-data">
    <table class="wp-list-table widefat fixed pages" cellspacing="0" style="width:95%;">
    	<thead>
    		<tr>
    			<th>Selecione imagem somente no formato jpg ou png</th>
    		</tr>
    	</thead>
    	<tbody>
    		<tr>
    			<td>
    				<br /><br />
    				<input type="file" name="imagem" />
    				<br />
    				<br />
    				<input type="submit" value="Cadastrar imagem" class="button-primary" />
    				<br />
    				<br />
    			</td>
    		</tr>
    		<tr>
    			<td align="center">
    				<br /><br />
    				<b>Imagem atual</b>
    				<br /><br />
    				<?php echo $imagemAtual; ?>
    			</td>
    		</tr>
    	</tbody>
    </table>
</form>