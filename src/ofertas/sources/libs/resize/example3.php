<?php
echo "Aqui a imagem eh escalada...";


include('core/class.simpleImage.php');
$image = new SimpleImage();
$image->load('example.jpg');
$image->scale(40);
$image->save('galeria/example3.jpg');

echo "<img src='galeria/example3.jpg'>";
?>