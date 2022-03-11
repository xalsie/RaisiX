<?php 
include_once("../includes/inc.php");
header("Content-Type: image/png");

//Créer une chaîne aléatoire entre 6 et 8 caractères
$length = rand(6,8);
$charAuthorized = "abcdefghijklmnopqrstuvwxyz1234567890";
$charAuthorized = str_shuffle($charAuthorized);
$captcha = substr($charAuthorized, -$length);
$_SESSION["captcha"]=$captcha;
$listOfFonts = glob("../assets/fonts/*.ttf");
$image = imagecreate(300, 100);

/*
	- Taille par caractère aléatoire
	- Police par caractère aléatoire (Les polices devront se trouver dans un dossier a la racine du projet au format ttf au moins 4)
	- Angle et position par caractère aléatoire
	- Couleur par caractère aléatoire
	- Couleur de fond aléatoire
	- Ajouter des formes géométriques aléatoires avec des couleurs utilisées dans les caractères (Nombre et formes aléatoires)
	- Contrainte : Doit toujours être lisible !!!
	- Note de CC (Code identique = 0)
*/
$startX = rand(10,20);

$backgroundColor = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));

for($i=0; $i<$length ; $i++){
	$fontSize[$i] = rand(20, 30);
	$fontName[$i] = __DIR__."/".$listOfFonts[array_rand($listOfFonts)];
	$fontAngle[$i] = rand(-30, 30);
	$fontPos[$i]["x"] = (isset($fontPos[$i-1]))
							?($fontPos[$i-1]["x"]+rand(30,40))
							:$startX;

	$fontPos[$i]["y"] = rand(30, 70);
	$fontColor[$i] = imagecolorallocate($image, rand(150,255),  rand(150,255),  rand(150,255));

	imagettftext($image, 
					$fontSize[$i], 
					$fontAngle[$i], 
					$fontPos[$i]["x"], 
					$fontPos[$i]["y"], 
					$fontColor[$i], 
					$fontName[$i], 
					$captcha[$i]);
}

$nbGeometry = rand(6,8);
for($j=0; $j<$nbGeometry; $j++){

	$color = $fontColor[array_rand($fontColor)];

	switch (rand(0,3)) {
		case 0:
			imageline($image, rand(0,300), rand(0,100), rand(0,300), rand(0,100), $color);
			break;
		case 1:
			imagerectangle($image, rand(0,300), rand(0,100), rand(0,300), rand(0,100), $color);
			break;
		case 2:
			imageellipse($image, rand(0,300), rand(0,100), rand(0,300), rand(0,100), $color);
			break;
		case 3:
			imagepolygon($image, [rand(0,300) ,rand(0,300) ,rand(0,300) ,rand(0,300) ,rand(0,300) ,rand(0,300)], 3, $color);
			break;
		default:
			die("Erreur de programmation");
			break;
	}

}

imagepng($image);