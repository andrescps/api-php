<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "crud";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlviajeros = mysqli_query($conexionBD,"SELECT * FROM viajeros WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlviajeros) > 0){
        $viajeros = mysqli_fetch_all($sqlviajeros,MYSQLI_ASSOC);
        echo json_encode($viajeros);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlviajeros = mysqli_query($conexionBD,"DELETE FROM viajeros WHERE id=".$_GET["borrar"]);
    if($sqlviajeros){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $cedula_viajero=$data->cedula_viajero;
    $fecha_nacimiento=$data->fecha_nacimiento;
    $telefono=$data->telefono;
        if(($correo!="")&&($nombre!="")&&($cedula_viajero!="")&&($fecha_nacimiento!="")&&($telefono!="")){
            
    $sqlviajeros = mysqli_query($conexionBD,"INSERT INTO viajeros(nombre,cedula_viajeros,fecha_nacimiento,telefono) VALUES('$nombre','$cedula_viajero','$fecha_nacimiento','$telefono')");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $cedula_viajero=$data->cedula_viajero;
    $fecha_nacimiento=$data->fecha_nacimiento;
    $telefono=$data->telefono;
    
    
    $sqlviajeros = mysqli_query($conexionBD,"UPDATE viajeros SET nombre='$nombre',cedula_viajero='$cedula_viajero',fecha_nacimiento='$fecha_nacimiento',telefono='$telefono' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlviajeros = mysqli_query($conexionBD,"SELECT * FROM viajeros ");
if(mysqli_num_rows($sqlviajeros) > 0){
    $viajeros = mysqli_fetch_all($sqlviajeros,MYSQLI_ASSOC);
    echo json_encode($viajeros);
}
else{ echo json_encode([["success"=>0]]); }


?>