<?php 
    require('connect.php');
    $tipo = $_POST['tipo'];
    $titulo = $_POST['nome'];
    $imagem = $_POST['foto'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    echo $lng;
    
    echo $lat;

    try {

        $conn->beginTransaction();

        $query = "INSERT INTO public.occurrences_point(name,type,point,image) VALUES (?,?, ST_GeomFromText('Point($lng $lat)',3763),?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([ $titulo,$tipo,$imagem]);

        $conn->commit();

       
        header("Location: ./leaflet/index.html");

    } catch(PDOException $e) {
        echo "Query failed: ".$e->getMessage();
        $conn->rollBack();
    }

?>