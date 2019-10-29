<?php 
    require 'vendor/autoload.php';
    $cliente = new MongoDB\Driver\Manager('mongodb://127.0.0.1/');
    $bucket = new  MongoDB\GridFS\Bucket($cliente, 'CECAR');
        $id = $_POST['id'];
        $des = $_POST['des'];
        $archivo = $_FILES['arc'];
        $nom_archivo = $_FILES["arc"]["name"];

        $target_dir = "subir/";
        $ruta  = $target_dir.basename($_FILES["arc"]["name"]);
        move_uploaded_file($_FILES["arc"]["tmp_name"],$ruta);

        $archivo = fopen($ruta,'rb');
        
        $bucket->uploadFromStream($nom_archivo, $archivo,['_id'=>$id, 'descripcion' => $des]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro exitoso</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div class="container p-4">
        <div class="card mx-auto" style="width: 45rem;">
            <div class="card-body">
                <h3 class="title"><strong>¡</strong>Archivo registrado <strong>correctamente!</strong></h3>
                <p>El archivo <strong><?php echo $nom_archivo?></strong> ha sido registado correctamente en la base de datos.</p>
                <a href="index.html" class="btn btn-success"><i class="fas fa-arrow-left"></i> Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>
