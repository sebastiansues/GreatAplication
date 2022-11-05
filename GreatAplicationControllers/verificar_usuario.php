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
		if (isset($_POST['usuario'])) {
				
			$usuario = $_POST['usuario'];
			
			$sql = "SELECT * FROM `usuarios` WHERE usuario ='".$usuario."';";
			$resultado = $conn->query($sql);

			if ($resultado->num_rows>0) {
				echo '{
					"codigo":202,
					"mensaje": "El usuario ya existe",
					"respuesta":"'.$resultado->num_rows.'"
					}';
			}else{
				echo '{
					"codigo":203,
					"mensaje": "El usuario no existe ",
					"respuesta":""
					}';
			}
			}else{
				echo '{
					"codigo":402,
					"mensaje": "Faltan datos para ejecutar la accion solicitada",
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