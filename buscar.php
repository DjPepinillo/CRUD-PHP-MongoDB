<?php
    require 'vendor/autoload.php';

    $cliente = new MongoDB\Driver\Manager('mongodb://127.0.0.1/');
    $bucket = new  MongoDB\GridFS\Bucket($cliente, 'CECAR');
    $id = $_POST['id'];

    $file_metadata = $bucket->findOne(["_id" => $id]);
    $ruta = "subir/".$file_metadata->filename;
    
    function leerArchivo($ruta){
        $narchivo = fopen($ruta, "r");
        echo fread($narchivo, filesize($ruta));
        fclose($narchivo);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contenido del archivo</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div class="container p-4">
        <div class="card">
            <div class="card-body">
                <a href="index.html" class="btn btn-success"><i class="fas fa-arrow-left"></i> Regresar</a>
                <hr>
                <h4 class="title">Contenido del archivo <strong><?php echo $file_metadata->filename;?></strong></h4>
                <hr>
                <div class="border border-primary p-2 rounded">
                    <pre>
<?php 
    if(!file_exists($ruta)){
        $downloadStream = $bucket->openDownloadStream($id);
        $stream = stream_get_contents($downloadStream, -1);
        $narchivo = fopen($ruta, "a+");
        fwrite($narchivo, $stream);
        fclose($narchivo);
    }else{
        leerArchivo($ruta);
    }
?>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</body>
</html>