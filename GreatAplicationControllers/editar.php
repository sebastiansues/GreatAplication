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
			isset($_POST['password'])) {

			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];
			$repassword = $_POST['repassword'];

			$sql = "SELECT * FROM `usuarios` WHERE usuario ='".$usuario."' and password='".$password."' ;";

			$resultado = $conn->query($sql);

			if ($resultado->num_rows>0) {
				// valida el usuario-----------------------------------------------------------------------------------------


				//edita usuario --------------------------------------------------------------------------------------
				
				$sql = "UPDATE `usuarios` SET `nombres` = '".$nombres."', `apellidos` = '".$apellidos."', `password` = '".$repassword."' WHERE usuario ='".$usuario."';";
				$conn->query($sql);

				echo '{
					"codigo":206,
					"mensaje": "Usuario actualizado con exito",
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