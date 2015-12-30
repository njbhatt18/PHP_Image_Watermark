
<?php
if(isset($_REQUEST['submit']))
{
	/*echo '<pre>';
	print_r($_SERVER);
	exit;*/
	$uploads_directory = $_SERVER['DOCUMENT_ROOT'];
	$uploadedfile = $_FILES['image']['tmp_name'];
	$src = imagecreatefromjpeg($uploadedfile);
	list($width,$height)=getimagesize($uploadedfile);
	
	$newwidth=34;
	$newheight=34;
	$tmp=imagecreatetruecolor($newwidth+20,$newheight+20);
	 
	$black = imagecolorallocatealpha($tmp, 0, 0,0, 127);
        
	$white = imagecolortransparent($tmp, $black);//imagecolorallocate($tmp, 255, 255, 255); 
	imagefill($tmp, 0, 0, $white); 
	imagecopyresampled($tmp,$src,10,10,0,0,$newwidth,$newheight,$width,$height);
	$filename = preg_replace('"\.(bmp|gif|jpg|jpeg|JPG|JPEG|BMP|GIF)$"', '.png', $_FILES['image']['name']);
	$file = $uploads_directory."/demo/". $filename;
	imagepng($tmp,$file,9);
	imagedestroy($src);
	imagedestroy($tmp); 
	
        
	
	$width = 44;
	$height = 50;

        //$filename = 'green-border.png';
	$base_image = imagecreatefrompng($filename);
	$top_image = imagecreatefrompng("green-border.png");
	$merged_image = md5(time()).$filename;

	imagesavealpha($top_image, true);
	imagealphablending($top_image, false);

	imagecopy($base_image, $top_image, 0, 0, 0, 0, $width, $height);
	imagepng($base_image, $merged_image);
	
	echo '<br><a href="index.php">Go back</a>';
}
else
{
?>


<form method="post" enctype="multipart/form-data">
<input type="file" name="image" />
<input type="submit" name="submit" value="Submit" />
</form>
<?php } ?>
