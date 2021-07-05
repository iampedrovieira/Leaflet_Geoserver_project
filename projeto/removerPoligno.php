<?php 
    require('connect.php');
    $id = $_POST['id'];
    echo $id;
    
    try {

        $conn->beginTransaction();

        $query = "DELETE FROM public.occurrences_polygon where id=?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $conn->commit();
        header("Location: ./leaflet/index.html");

    } catch(PDOException $e) {
        echo "Query failed: ".$e->getMessage();
        $conn->rollBack();
    }

?>