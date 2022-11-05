<?php
include 'header.php';

try {
	$conn = mysqli_connect($db_servidor,$db_usuario,$db_pass,$db_baseDatos);

	if (!$conn) {
		echo '{
				"codigo":400,
				"mensaje": "Error al conectar ",
				"respuesta":""
				}';
	}else
	{
		if (isset($_POST['nombres']) && 
			isset($_POST['apellidos']) &&  
			isset($_POST['usuario']) &&  
			isset($_POST['password'])) 
		{
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM `usuarios` WHERE usuario ='".$usuario."';";
			$resultado = $conn->query($sql);

			if ($resultado->num_rows>0) {
				echo '{
					"codigo":403,
					"mensaje": "Ya existe un usuario registrado con ese nombre",
					"respuesta":"'.$resultado->num_rows.'"
					}';
			}else{
				$sql = "INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `password`) VALUES (NULL, '".$nombres."', '".$apellidos." ', '".$usuario."', '".$password."');";

				if ($conn->query($sql) === True) {
					echo '{
						"codigo":201,
						"mensaje": "Usuario creado correctamente",
						"respuesta":""
						}';
				}else{
					echo '{
						"codigo":401,
						"mensaje": "Error intentando crear usuario ",
						"respuesta":""
						}';
				}
			}
			
			}else{
				echo '{
					"codigo":402,
					"mensaje": "Faltan datos para crear el usuario",
					"respuesta":""
					}';
			}

		
}
} catch (Exception $e) {
	
		echo '{
				"codigo":400,
				"mensaje": "Error al conectar ",
				"respuesta":""
				}';
}
include 'cerrar_bd.php';