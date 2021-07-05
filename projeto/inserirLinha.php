<?php 
    require('connect.php');
    $tipo = $_POST['tipo'];
    $titulo = $_POST['nome'];
    $imagem = $_POST['foto'];
    $linha = $_POST['linha'];
    $dados = explode("),",$linha[0]);
    $pontos="";
    foreach ($dados as $coordenada) {
        
        $lat = explode(",",explode('LatLng(' ,$coordenada)[1])[0];
        
        $lng = explode(",",explode('LatLng(' ,$coordenada)[1])[1];

        $pontos = $pontos."," . (string)$lng ." ".(string)$lat;
        
    }
    $pontos_finais = str_replace(", ",",",str_replace(')', '',substr($pontos,1)));

    echo $pontos_finais;
    try {

        $conn->beginTransaction();

        $query = "INSERT INTO public.occurrences_line(name,type,line,image) VALUES (?,?,ST_GeomFromText('LineString($pontos_finais)',3763),?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$titulo,$tipo,$imagem]);

        $conn->commit();

       
        header("Location: ./leaflet/index.html");

    } catch(PDOException $e) {
        echo "Query failed: ".$e->getMessage();
        $conn->rollBack();
    }  

?>
