<?php

if ($_POST) {
    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];

    if (isset($_POST["btnInsertar"])) {
        //primero creamos el array esto para json
        $aClientes = array(
            "dni" => $dni,
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo
        );

        //conveimos el array a json
        $strJson = json_encode($aClientes);

        //guardamos el json en el archivo
        file_put_contents("archivo1.txt", $strJson);
    } else if(isset($_POST["btnActualizar"])){

    } if(isset($_POST["btnBorrar"])){
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-3">
                <h1>Registro de Clientes</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">DNI:</label>
                        <input type="text" id="txtDni" name="txtDni" class="form-control" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Nombre y apellido:</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Telefono:</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Correo:</label>
                        <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <button type="submit" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Insertar</button>
                        <button type="submit" id="btnLimpiar" name="btnLimpiar" class="btn btn-secondary">Limpiar</button>
                        <button type="submit" id="btnBorrar" name="btnBorrar" class="btn btn-danger">Borrar</button>
                        <button type="submit" id="btnActualizar" name="btnActualizar" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <table>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    
</body>
</html>