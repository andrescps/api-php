<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "crud";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);



if (isset($_GET["consultar"])){
    $sqlviaje = mysqli_query($conexionBD,"SELECT * FROM viajes WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlviajes) > 0){
        $viajes = mysqli_fetch_all($sqlviajes,MYSQLI_ASSOC);
        echo json_encode($viajes);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["borrar"])){
    $sqlviajes = mysqli_query($conexionBD,"DELETE FROM viajes WHERE id=".$_GET["borrar"]);
    if($sqlviajes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $codigo_viaje=$data->codigo_viaje;
    $numero_plazas=$data->numero_plazas;
    $destino=$data->destino;
    $origen=$data->origen;
    $precio=$data->precio;
        if(($codigo_viaje!="")&&($numero_plazas!="")&&($destino!="")&&($origen!="")&&($precio!="")){
            
    $sqlviajes = mysqli_query($conexionBD,"INSERT INTO viajes(codigo_viaje,numero_plazas,destino,origen,precio) VALUES('$codigo_viaje','$numero_plazas','$destino','$origen','$precio')");
    echo json_encode(["success"=>1]);
        }
    exit();
}



if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $codigo_viaje=$data->codigo_viaje;
    $numero_plazas=$data->numero_plazas;
    $destino=$data->destino;
    $origen=$data->origen;
    $precio=$data->precio;
    
    
    $sqlviajes = mysqli_query($conexionBD,"UPDATE viajes SET codigo_viaje='$codigo_viaje',numero_plazas='$numero_plazas',destino='$destino',origen='$origen',precio='$precio' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlviajes = mysqli_query($conexionBD,"SELECT * FROM viajes ");
if(mysqli_num_rows($sqlviajes) > 0){
    $viajes = mysqli_fetch_all($sqlviajes,MYSQLI_ASSOC);
    echo json_encode($viajes);
}
else{ echo json_encode([["success"=>0]]); }


?>
