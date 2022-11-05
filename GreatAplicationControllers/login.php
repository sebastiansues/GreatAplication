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
		if (isset($_POST['usuario'])&& isset($_POST['password'])) {
				
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM `usuarios` WHERE usuario ='".$usuario."' and password='".$password."' ;";

			$resultado = $conn->query($sql);

			if ($resultado->num_rows>0) {
				// valida el usuario-----------------------------------------------------------------------------------------
				echo '{
					"codigo":205,
					"mensaje": "Inicio de sesion",
					"respuesta":" '.$usuario.' "
					}';
			}else{
				echo '{
					"codigo":204,
					"mensaje": "Usuario o password incorrectos",
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