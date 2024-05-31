<?php 
    session_start();
    include "./db.php";
        try {
            $preparada = $db->prepare("DELETE FROM usuarios WHERE ID = :id");
            $preparada->bindParam(':id', $_SESSION['id']);
            $preparada->execute();

            header("Location: ./Login.php");
        } catch (PDOException $e) {
            echo "Error en la base de datos " . $e->getMessage();
        }
        
?>