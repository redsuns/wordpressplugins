<?php
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   	function load($nomeReal) {
   		/**
   		 * @desc Carregar arquivo de imagem
   		 * @param String $filename
   		 */
   		 	 
	      $image_info = getimagesize($nomeReal);
		  
	      $this->image_type = $image_info['mime'];
	      if( $this->image_type == 'image/jpeg' ) {
	         $this->image = imagecreatefromjpeg($nomeReal);
	      } elseif( $this->image_type == 'image/gif' ) {
	         $this->image = imagecreatefromgif($nomeReal);
	      } elseif( $this->image_type == 'image/png' ) {
	         $this->image = imagecreatefrompng($nomeReal);
	      }
		  
		  //die(print_r($this->image_type));
   	}
   	## --- ##
   	
   	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
   		/**
   		 * @desc Salva imagem
   		 * @param String $filename, $image_type, $compression
   		 */
 			//die(print_r($filename));
	      if( $image_type == IMAGETYPE_JPEG ) {
	         imagejpeg($this->image,$filename,$compression);
	      } elseif( $image_type == IMAGETYPE_GIF ) {
	         imagegif($this->image,$filename);
	      } elseif( $image_type == IMAGETYPE_PNG ) {
	         imagepng($this->image,$filename);
	      }
	      if( $permissions != null) {
	         chmod($filename,$permissions);
	      }

   	}
   	## --- ##
   
   	function output($image_type=IMAGETYPE_JPEG) {
			/**
			 * @desc Mostra imagem
			 * @param String $image_type
			 */
 
		      if( $image_type == IMAGETYPE_JPEG ) {
		         imagejpeg($this->image);
		      } elseif( $image_type == IMAGETYPE_GIF ) {
		 
		         imagegif($this->image);
		      } elseif( $image_type == IMAGETYPE_PNG ) {
		 
		         imagepng($this->image);
		      }
      
   	}
   	## --- ##
   	
   	
   function getWidth() {
   		/**
   		 * @desc Pega a largura
   		 * @param none
   		 */
   		 
   		 $width = 100;
		 
		 $widthImagem = imagesx($this->image);
		 if($widthImagem)
		 {
		 	$width = $widthImagem;
		 }
 
      	return $width;
      	
   }
   ## --- ##
   
   
   function getHeight() {
   		/**
   		 * @desc Pega a altura
   		 * @param none
   		 */
   		 
   		$height = 100;
 		
		$heightImagem = @imagesy($this->image);
		
		if($heightImagem)
		{
			$height = $heightImagem;
		}
 
      	return $height;
      	
   }
   ## --- ##
   
   function resizeToHeight($height) {
 		/**
 		 * @desc Redimensiona altura
 		 * @param Int $height
 		 */
	      $ratio = $height / $this->getHeight();
	      $width = $this->getWidth() * $ratio;
	      $this->resize($width,$height);
	      
   }
   ## --- ##
 
   function resizeToWidth($width) {
   		/**
   		 * @desc Redimensiona largura
   		 * @param Int $width
   		 */
   			
	      $ratio = $width / $this->getWidth();
	      $height = $this->getheight() * $ratio;
	      $this->resize($width,$height);
		  
   }
   ## --- ##
 
   function scale($scale) {
   		/**
   		 * @desc Escala a imagem (Proporção)
   		 * @param Int $scale
   		 */
	      $width = $this->getWidth() * $scale/100;
	      $height = $this->getheight() * $scale/100;
	      $this->resize($width,$height);
	      
   }
   ## --- ##
 
   function resize($width,$height) {
   		/**
   		 * @desc Redimensiona a imagem
   		 * @param Int $width, $height
   		 */
   		
   			$width2 = $this->getWidth();
			$height2 = $this->getHeight();
   		
   			if(!$width || ! $width2)
			{
				$width = '860';
				$width2 = '860';
			}
			
			if(!$height || !$height2)
			{
				$height = '640';
				$height2 = '640';
			}
			
   			
	      $new_image = imagecreatetruecolor($width, $height);
		  
		  
		  if(!imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $width2, $height2))
		  {
		  	die("<br /><br /><h3>Tipo de arquivo ou nome n&atilde;o permitido, por favor adicione uma imagem em formato e extens&atilde;o jpg e com o nome sem acentua&ccedil;&otilde;es.</h3><br /><br /><a href='javascript:;' onclick='window.history.go(-1);'>Voltar</a>");
		  }
		  else 
		  {
			 $this->image = $new_image; 
		  }
		  
	     
   }
   ## --- ##
 
}
?>