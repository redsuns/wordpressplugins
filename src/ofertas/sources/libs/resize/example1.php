<?php

echo "Neste exemplo serta redimensionado conforme o valor definido<br /><br /><br />";

	$altura = isset($_POST['altura']) ? $_POST['altura'] : '200';
	$largura = isset($_POST['largura']) ? $_POST['largura'] : '400';
	
   include('core/class.simpleImage.php');
   $image = new SimpleImage();
   $image->load('example.jpg');
   $image->resize($largura,$altura);
   $image->save('galeria/example1.jpg');
   
   echo "<img src='galeria/example1.jpg'>";
?>


<form action="" method="post">
Altura <input type="text" name="altura" >
Largura <input type="text" name="largura" >
<input type="submit" value="Redimensionar" >

</form>