<?php 
    session_start();
    include "../../conexion_be.php";
        try {
            $id_usuario = $_SESSION['id'];
            $preparada = $db->prepare("DELETE FROM usuarios WHERE ID = :id");
            $preparada->bindParam(':id', $id_usuario);
            $preparada->execute();

            header("Location: ../registro/registro.php");
        } catch (PDOException $e) {
            echo "Error en la base de datos " . $e->getMessage();
        }
        
?>