<?php
include_once("../includes/inc.php");
include('../assets/animegif/GIFEncoder.class.php');
header ('Content-type: image/gif');

$captcha = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 2, 7);
$_SESSION["captcha"] = strtolower($captcha);

$x			    = 230;
$y			    = 115;
$z			    = 0;
$space		    = 15;
$interval	    = 30;
$letext		    = 5;
$j			    = 10;
$space		    = 15;
$a              = rand(-30,30);
$b              = rand($y / 3,90);
$listOfFonts    = glob("../assets/fonts/Ed Wood Movies.ttf");

function generateRandomFont() {
	if ($directory = opendir('../assets/fonts')) {
		$i = 0;
		while (false !== ($fonts = readdir($directory))) {
			if ($fonts!= "." && $fonts != "..") {
				$table[$i]=$fonts;
				$i++;
			}
		}
		closedir($directory);
	}
	$alea = rand(0, $i - 1 );
	return "/assets/fonts/".$table[$alea];
}

for($i = 0; $i <= (strlen($captcha) - 1); $i++) {
    $letext = ($letext + $j);
    // Open the first source image and add the text.
    $image = imagecreate($x, $y);
    $text_color = imagecolorallocate($image, 200, 200, 200);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    // imagestring($image, 5, $letext, 10,  substr($text, $i, 1), $black);
    $_rand = rand(16,24);
    for($j = 0; $j <= $_rand; $j++) {
        imageline($image,rand($z,$x),rand($z, $y),rand($z,$x),rand($z, $y),imagecolorallocate($image,rand(100,120),rand(100,120),rand(100,120)));
    }
    for($j = 0; $j <= $_rand; $j++) {
        imageline($image,rand($z,$x),rand($z, $y),rand($z,$x),rand($z, $y), $black);
    }
    $space = 15;
    for($j = 0; $j <= (strlen($captcha) - 1); $j++) {
        //imagettftext ( $image , 25 , rand(-70,70) , $space, ($y/2), $black , "Font/2.ttf", substr($captcha, $j, 1));
        // imagettftext ( $image , 25 , rand(-40,40) , $space, rand($y / 4,90), $black , generateRandomFont(), substr($captcha, $j, 1));

        $fontName[0] = __DIR__."/".$listOfFonts[array_rand($listOfFonts)];

        imagettftext($image, 25, $a, $space, $b, $black, $fontName[0], substr($captcha, $j, 1));

        $space += $interval;
    }
    // Generate GIF from the $image
    // We want to put the binary GIF data into an array to be used later,
    //  so we use the output buffer.
    ob_start();
    imagegif($image);
    $frames[]=ob_get_contents();
    $framed[]=100; // Delay in the animation.
    ob_end_clean();
}
// Generate the animated gif and output to screen.
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
echo $gif->GetAnimation();