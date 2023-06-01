<?php
session_start();

// Verificar si hay un mensaje de error almacenado en $_SESSION
$error_message = isset($_SESSION['form_error_message']) ? $_SESSION['form_error_message'] : "";
unset($_SESSION['form_error_message']); // Limpiar el mensaje de error de $_SESSION
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets\dist\bootstrap-5.3.0-alpha3-dist\css\bootstrap.rtl.min.css" rel="stylesheet">
	<script src="assets\dist\bootstrap-5.3.0-alpha3-dist\js\popper.min.js"></script>
	<script src="assets\dist\bootstrap-5.3.0-alpha3-dist\js\bootstrap.min.js"></script>
	<title>Control de asistenciass</title>
</head>

<body>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card mt-5">
					<div class="card-body">
						    <!-- Mostrar el mensaje de error si existe -->
    <?php if (!empty($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>

						<h1 class="text-center mb-4">Iniciar Sesión</h1>
						<form method="post" action="login.php">
							<div class="form-group">
								<label for="matricula">Matrícula:</label>
								<input type="text" class="form-control" name="matricula" required>
							</div>
							<div class="form-group">
								<label for="contrasena">Contraseña:</label>
								<input type="password" class="form-control" name="contrasena" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
						</form>
						<p class="mt-3 text-center">¿No tienes cuenta? <a href="registro_form.php">Crear una</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

</body>

</html>