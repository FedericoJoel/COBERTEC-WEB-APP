<?php
	require("conexion.php");

	$db= new Conexion();

	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
     
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
     
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
     
        exit(0);
   	}


	$data = json_decode(file_get_contents("php://input"));

	$clinica = $db->real_escape_string($data->clinica);

	$query = $db->query("SELECT * FROM Climed WHERE IDCLI = '$clinica'") or die ("Fallo Mostrar Clinica");

	$row = $db->recorrer($query);
	
	print json_encode($row);

?>

