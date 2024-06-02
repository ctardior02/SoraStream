<?php 
    session_start();
    include "./db.php";
        try {
            $eliminarFav = $db->prepare("DELETE FROM favoritos WHERE ID_Usuario = :id");
            $eliminarFav->bindParam(':id', $_SESSION['id']);
            $eliminarFav->execute();
            
            $eliminarHist = $db->prepare("DELETE FROM historial WHERE usuario = :id");
            $eliminarHist->bindParam(':id', $_SESSION['id']);
            $eliminarHist->execute();

            $preparada = $db->prepare("DELETE FROM usuarios WHERE ID = :id");
            $preparada->bindParam(':id', $_SESSION['id']);
            $preparada->execute();

            header("Location: ./Login.php");
        } catch (PDOException $e) {
            echo "Error en la base de datos " . $e->getMessage();
        }
        
?>