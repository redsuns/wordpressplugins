<?php
echo "Este exemplo redimensiona somente a largura, presevando a proporcao<br /><br />";

include('core/class.simpleImage.php');
$image = new SimpleImage();
$image->load('example.jpg');
$image->resizeToWidth(250);
$image->save('galeria/example2.jpg');

echo "<img src='galeria/example2.jpg'>";

?>