<?php

require_once __DIR__.'/../DatabaseManager.php';
require_once ("../../bdd.php");

$databaseManager = new DatabaseManager($connexion);
$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata, true);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

if ($method == 'POST') {
    if (!isset($data['NOM_LIVRE']) || !isset($data['AUTEUR']) || !isset($data['GENRE']) || !isset($data['EDITIONS']) || !isset($data['SOUHAIT']) || !isset($data['IMAGES'])) {
        http_response_code(400);
        echo json_encode(array("success" => false, "error" => "Un ou plusieurs paramètres requis manquants"));
        exit;
    }

    $ID_UTILISATEUR = $data['ID_UTILISATEUR'];
    $titre = $data['NOM_LIVRE'];
    $Datatome = isset($data['TOME']) ? $data['TOME'] : null;
    $tome = is_numeric($Datatome) ? (int)$Datatome : null;
    $auteur = $data['AUTEUR'];
    $genre = $data['GENRE'];
    $editions = $data['EDITIONS'];
    $date = date("Y-m-d");
    $souhait = $data['SOUHAIT'];

    $imageData = $data['IMAGES'];

    $fileName = uniqid() . '.jpg'; 
    $filePath = "../../images-livres/" . $fileName; 

  
    $file = fopen($filePath, 'wb');
    fwrite($file, base64_decode($imageData));
    fclose($file);

    $imageUrl = 'http://booky-bibliotheque.fr/images-livres/' . $fileName;

    try {
        $created = $databaseManager->postLivre($ID_UTILISATEUR, $titre, $tome, $auteur, $genre, $editions, $date, $souhait, $fileName); 

        if ($created) {
            http_response_code(201);
            echo json_encode(array("success" => true, "message" => "Livre ajouté avec succès", "imageUrl" => $imageUrl));
        } else {
            http_response_code(500);
            echo json_encode(array("success" => false, "error" => "Erreur lors de l'ajout du livre"));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("success" => false, "error" => $e->getMessage()));
    }
} else {
    http_response_code(405);
    echo json_encode(array("success" => false, "error" => "Méthode non autorisée"));
}


?>
