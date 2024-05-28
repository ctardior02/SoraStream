<?php
session_start();
$data = file_get_contents("php://input");
include "./db.php";

$hist = $db->prepare("INSERT INTO historial (Fecha, anime, usuario) VALUES (:fecha, :idAnime, :idUsuario)");
$hist->bindParam(":fecha", date("Y-m-d H:i:s"));
$hist->bindParam(":idAnime", $data);
$hist->bindParam(":idUsuario", $_SESSION["id"]);
$hist->execute();

?>