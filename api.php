<?php
header('Content-Type: application/json');

define("HOST", 'fojvtycq53b2f2kx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com');
define("USER", "l00a2841lw6mjssr");
define("PASSWORD", "xwt8xkntm0bwbnpp");
define("PORT", "3306");
define("DATABASE", "afemnk19c7xq8sim");

try {
    $pdo = new PDO('mysql:host=fojvtycq53b2f2kx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3306;dbname=afemnk19c7xq8sim', USER, PASSWORD);


} catch (PDOException $e) {

    die($e->getMessage());

}

$requete = $pdo->prepare("SELECT * FROM `property`");
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
$result["properties"] = $resultats;

echo json_encode($result);


?>
