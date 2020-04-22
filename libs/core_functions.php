<?php

//Recuperation des données transmises
function getField($fieldValue) {
    if (isset($fieldValue) && $fieldValue != '') {
        $fieldValue = htmlspecialchars(trim($fieldValue));
    } else {
        echo "<p class='alert labelInfo-danger col-lg-offset-3'>Completer les champs vides!</p>";
        exit;
    }
    return $fieldValue;
}

//Make a pic thumbnail
function thumbnailAPic($file, $extension, $size_y, $size_x) {
    $source = null;
    if ($extension == "jpg" || $extension == "jpeg") {
        $source = imagecreatefromjpeg($file);
    } else if ($extension == "png") {
        $source = imagecreatefrompng($file);
    } else {
        echo "Format de l'image non supporté";
        header('location: index.php?erreur');
    }

    $destination = imagecreatetruecolor($size_y, $size_x);
// Les fonctions imagesx et imagesy renvoient la largeur et la
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    //$size_x = $size_y*($hauteur_source/$largeur_source);
    //Make it some proportional

    $largeur_destination = imagesx($destination);
    $hauteur_destination = imagesy($destination);

    // On crée la miniature
    imagecopyresampled($destination, $source, 0, 0, 0, 0,
            $largeur_destination, $hauteur_destination, $largeur_source,
            $hauteur_source);
// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
    $_SESSION["thumbnail_name"] = "img/thumbnails/" . rand() . "_mini.png";
    imagepng($destination, $_SESSION["thumbnail_name"]);
}

function countGeneratedCards() {
    $fi = new FilesystemIterator("img/thumbnails/", FilesystemIterator::SKIP_DOTS);
    if(iterator_count($fi)==0){
        return "Aucune carte generée <br/>";
    }else if (iterator_count($fi)==1){
        return iterator_count($fi). " Carte generée <br/>";
    }else{
         return iterator_count($fi). " Cartes generées <br/>";
    }

}
