<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('error_reporting', E_ALL);


if (file_exists("clientes.txt")) {
    $jsonClientes = file_get_contents("clientes.txt");
    $aClientes = json_decode($jsonClientes, true);
} else {
    $aClientes = array();
}

$pos = isset($_GET["pos"]) ? $_GET["pos"] : "";


if ($_POST) { /* es postback, porque alguien hizo clic en guardar */
    //Definicion de variables
    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];

    if (isset($_GET["do"]) && $_GET["do"] == "edit") {
        //Modificar la posicion del cliente a editar, cambiando por los nuevos campos
        $aClientes[$pos] = array(
            "dni" => $dni,
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo
        );

        //Convertir el array en json
        $jsonClientes = json_encode($aClientes);

        //Guardar en el archivo la variable json
        file_put_contents("clientes.txt", $jsonClientes);
    } else {
        //Convertir los datos del formulario en un array
        $aClientes[] = array(
            "dni" => $dni,
            "nombre" => $nombre,
            "telefono" => $telefono,
            "correo" => $correo
        );

        //Convertir el array en json
        $jsonClientes = json_encode($aClientes);

        //Guardar en el archivo la variable json
        file_put_contents("clientes.txt", $jsonClientes);
    }
}

if (isset($_GET["do"]) && $_GET["do"] == "delete") {
    unset($aClientes[$pos]);
    //Guardar en el archivo, el nuevo array de clientes modificado
    $jsonClientes = json_encode($aClientes);
    file_put_contents("clientes.txt", $jsonClientes);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://josemoreno.com.ar/css/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="https://josemoreno.com.ar/css/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://josemoreno.com.ar/css/clientes.css">
</head>

<body>
    <div class="container">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1>Registro de clientes</h1>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-sm-6 col-12">
                <form action="" method="POST">
                    <div class="row p-0 m-0">
                        <div class=" col-sm-12 col-6 form-group">
                            <label for="txtDni"></label>
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="txtDni" name="txtDni" class="form-control" placeholder="DNI" required value="<?php echo isset($aClientes[$pos]["dni"]) ? $aClientes[$pos]["dni"] : ""; ?>">
                        </div>
                        <div class="col-sm-12 col-6 form-group">
                            <label for="txtNombre"></label>
                            <i class="fas fa-user-circle"></i>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="NOMBRE" required value="<?php echo isset($aClientes[$pos]["nombre"]) ? $aClientes[$pos]["nombre"] : ""; ?>">
                        </div>
                        <div class="col-sm-12 col-6 form-group">
                            <label for="txtTelefono"></label>
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" placeholder="TELÉFONO" required value="<?php echo isset($aClientes[$pos]["telefono"]) ? $aClientes[$pos]["telefono"] : ""; ?>">
                        </div>
                        <div class="col-sm-12 col-6 form-group">
                            <label for="txtCorreo"></label>
                            <i class="fas fa-mail-bulk"></i>
                            <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="CORREO" required value="<?php echo isset($aClientes[$pos]["correo"]) ? $aClientes[$pos]["correo"] : ""; ?>">
                        </div>
                    </div>
                    <div class="row mx-1 my-3">
                        <div class="col-sm-12 col-6">
                            <button type="submit" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 col-12 pl-0">
                <div class="row">
                    <div class="col-12">
                        <a href="index.php?do=new"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>
                <table class="table table-hover border">
                    <tr>
                        <th class="agua">DNI</th>
                        <th class="agua">Nombre</th>
                        <th class="agua">Correo</th>
                        <th class="agua">Acciones</th>
                    </tr>
                    <?php
                    foreach ($aClientes as $pos => $cliente) {  ?>

                        <tr>
                            <td><?php echo $cliente["dni"]; ?></td>
                            <td><?php echo $cliente["nombre"]; ?></td>
                            <td><?php echo $cliente["correo"]; ?></td>
                            <td>
                                <a href="?pos=<?php echo $pos; ?>&do=edit"><i class="fas fa-edit"></i></a>
                                <a href="?pos=<?php echo $pos; ?>&do=delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>