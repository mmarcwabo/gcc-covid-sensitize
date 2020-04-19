<?php

session_start();

//Functions
include_once './libs/core_functions.php';

//Text to add here
//Get them from forms
$name = (isset($_POST['name']))? getField($_POST['name']) : "GCC";
$role = (isset($_POST['role']))? getField($_POST['role']) : "Goma Cycling Club";
//validate file sent
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0) {
// Testons si le fichier n'est pas trop gros
    if ($_FILES['photo']['size'] <= 1000000) {
// Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['photo']['name']);
        $_SESSION['profile_photo'] = basename($_FILES['photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $_SESSION['extension_photo'] = $extension_upload;
        $extensions_autorisees = array('jpg', 'jpeg', 'gif',
            'png');
        if (in_array($extension_upload,
                        $extensions_autorisees)) {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['photo']['tmp_name'], 'img/uploads/' .
                    basename($_FILES['photo']['name']));
            echo "L'envoi a bien été effectué !";
        }
    }
}

//the profile image goes here, if not available
//we take the default image
if(isset($_SESSION['profile_photo'])){
    thumbnailAPic("img/uploads/".$_SESSION['profile_photo'],
            $_SESSION['extension_photo'], 200, 200);
    
    $source = imagecreatefrompng($_SESSION["thumbnail_name"]);
}else{
    $source = imagecreatefrompng("img/default.png");
}

//The main background image here
$destination = imagecreatefrompng("img/main_image.png");

// Arial
$font = imageloadfont('./arial.gdf');

//The main image parameters
$sourceWidth = imagesx($source);
$sourceHeight = imagesy($source);
$destinationWidth = imagesx($destination);
$hauteur_destination = imagesy($destination);

//Place the profile image
$destination_x = 0;
$destination_y = $hauteur_destination / 2;

// On ajoute le profil à l'image
imagecopymerge($destination, $source, $destination_x,
        $destination_y, 0, 0, $sourceWidth, $sourceHeight, 90);
//Save temporarily the image
$pathOfImage = "img/custom/" . rand() . "img.png";
$_SESSION['current_image'] = $pathOfImage;
imagepng($destination, $pathOfImage);

//Create the text for name here
$textName = imagecreate(200, 24);
$textRole = imagecreate(200, 23);

//Define text colors here
$white = imagecolorallocate($textName, 255, 255, 255);
$blackCol = imagecolorallocate($textName, 1, 2, 0);
//Define text colors
$fillRoleBg = imagecolorallocate($textRole, 255, 255, 255);
$blue = imagecolorallocate($textRole, 53, 103, 176);

imagestring($textName, $font, 0, 0, $name, $blackCol);

imagestring($textRole, $font, 0, 0, $role, $blue);
//Save temporarily the image
$pathOfNameImage = "img/custom/" . rand() . "img_name.png";
$pathOfRoleImage = "img/custom/" . rand() . "img_role.png";

$_SESSION['current_name'] = $pathOfNameImage;
$_SESSION['current_role'] = $pathOfRoleImage;
imagepng($textName, $pathOfNameImage);
imagepng($textRole, $pathOfRoleImage);
//Merge the new text to the image
$imageWithName = imagecreatefrompng($pathOfImage);
imagecopymerge($imageWithName, imagecreatefrompng($pathOfNameImage), $destination_x,
        $destination_y + 205, 0, 0, 200, 50, 99);
//Replace the former image
imagepng($imageWithName, $_SESSION['current_image']);

//Add the role
$imageWithRole = imagecreatefrompng($_SESSION['current_image']);
imagecopymerge($imageWithRole, imagecreatefrompng($pathOfRoleImage), $destination_x,
        $destination_y + 225, 0, 0, 200, 50, 99);
//Replace the former image
imagepng($imageWithRole, $_SESSION['current_image']);
// Print Text On Image
//imagepng($withPhoto);
header('Location: index.php');


