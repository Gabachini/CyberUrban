<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>CyberUrban</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
		<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
		<meta name="author" content="gettemplates.co" />

		<!-- Facebook and Twitter integration -->
		<meta property="og:title" content=""/>
		<meta property="og:image" content=""/>
		<meta property="og:url" content=""/>
		<meta property="og:site_name" content=""/>
		<meta property="og:description" content=""/>
		<meta name="twitter:title" content="" />
		<meta name="twitter:image" content="" />
		<meta name="twitter:url" content="" />
		<meta name="twitter:card" content="" />
		
		<!-- Animate.css -->
		<link rel="stylesheet" href="css/animate.css">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="css/icomoon.css">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="css/bootstrap.css">
		<!-- Theme style  -->
		<link rel="stylesheet" href="css/style.css">

		<!-- Modernizr JS -->
		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
    	<div class="fh5co-loader"></div>
		<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="container">
				<div class="row">	
					<div class="col-xs-2">
						<div id="fh5co-logo">CyberUrban</div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="InfoPersonalCl.php">Información personal</a></li>
							<li><a href="about.html">Sobre nosotros</a></li>
							<li><a href="services.html">Services</a></li>
							<li><a href="programas.html">Programas para empresas</a></li>
							<li><a href="work.html">Empresas colaboradoras</a></li>
							<li><a href="contact.html">Contacto</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>

		<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm-2" role="banner" style="background-image:url(images/Img1.jpeg);">
		</header>

		<div id="fh5co-core-feature">
			<div class="container">
				<div class="row">
					<div class="features">
						<div class="col-half animate-box" data-animate-effect="fadeInLeft">
							<div class="desc">
								<h3>Información personal</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			$DATABASE_HOST = 'localhost';
			$DATABASE_USER = 'root';
			$DATABASE_PASS = '';
			$DATABASE_NAME = 'cyberurban';
			$email = $_GET['cosa'];
		
			$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
		
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM clients where Email = '$email'";
			$result = $conn->query($sql);

			// Verificar si se obtuvieron resultados
			if ($result->num_rows > 0) {
				// Imprimir datos de cada fila
				while ($row = $result->fetch_assoc()) {
					echo "<table border='1' id='tabla' border='1'; width='520'>
						<tr>
							<th>Nombre</th></th>
							<td>" . $row["Nom"] . "</td>
						</tr>;

						<tr>
							<th>Dirección</th>
							<td>" . $row["Direccio"] . "</td>
						</tr>;

						<tr>
							<th>Número de teléfono</th>
							<td>" . $row["NumTelefon"] . "</td>
						</tr>;

						<tr>
							<th>Usuario</th>
							<td>" . $row["UsuariEmpresa"] . "</td>
						</tr>;

						<tr>
							<th>Correo</th>
							<td>" . $row["Email"] . "</td>
						</tr>";
				}
				echo "</table>";
			} else {
				echo "No se encontraron resultados.";
			}
			$conn->close();
		?>

		<br>

		<div id="button1">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Cambiar datos</button>
		</div>

		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="column" id="main">
								<form method="post">
									<div class="form-group">
										<label for="exampleInputEmail1">Nombre</label>
										<input type="text" class="form-control" name="InputName1" id="InputName1" aria-describedby="emailHelp" placeholder="Nombre">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Dirección</label>
										<input type="text" class="form-control" name="InputPath1" id="InputPath1" aria-describedby="emailHelp" placeholder="Dirección">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Número de télefono</label>
										<input type="text" class="form-control" name="InputNumbre1" id="InputNumbre1" aria-describedby="emailHelp" placeholder="télefono">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Usuario</label>
										<input type="text" class="form-control" name="InputUsername1" id="InputUsername1" aria-describedby="emailHelp" placeholder="Usuario">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Correo electrónico</label>
										<input type="email" class="form-control" name="InputEmail1" id="InputEmail1" aria-describedby="emailHelp" placeholder="Correo">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Clave</label>
										<input type="password" class="form-control" name="InputPassword1" id="InputPassword1" placeholder="Contraseña">
									</div>
									<button type="submit" class="btn btn-primary">Cambiar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			$DATABASE_HOST = 'localhost';
			$DATABASE_USER = 'root';
			$DATABASE_PASS = '';
			$DATABASE_NAME = 'cyberurban';
			$email = $_GET['cosa'];
		
			$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
		
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$nombre = isset($_POST['InputName1']) ? $_POST['InputName1'] : '';
			$direccion = isset($_POST['InputPath1']) ? $_POST['InputPath1'] : '';
			$telefono = isset($_POST['InputNumbre1']) ? $_POST['InputNumbre1'] : '';
			$usuario = isset($_POST['InputUsername1']) ? $_POST['InputUsername1'] : '';
			$correo = isset($_POST['InputEmail1']) ? $_POST['InputEmail1'] : '';
			$clave = isset($_POST['InputPassword1']) ? $_POST['InputPassword1'] : '';

			if (!empty($nombre)) {
				$ssql1 = "UPDATE clients SET Nom='$nombre' WHERE Email='$email'";
				$conn->query($ssql1);
			}

			//-------------------------------------------------------------------
			
			if (!empty($direccion)) {
				$ssql2 = "update clients set Direccio='$direccion' where Email='$email'";
				$conn->query($ssql2);
			}

			//-------------------------------------------------------------------

			if (!empty($telefono)) {
				$ssql3 = "update clients set NumTelefon='$telefono' where Email='$email'";
				$conn->query($ssql3);
			}

			//-------------------------------------------------------------------

			if (!empty($usuario)) {
				$ssql4 = "update clients set UsuariEmpresa='$usuario' where Email='$email'";
				$conn->query($ssql4);
			}

			//-------------------------------------------------------------------

			if (!empty($correo)) {
				$ssql5 = "update clients set Email='$correo' where Email='$email'";
				$conn->query($ssql5);
			}

			//-------------------------------------------------------------------

			if (!empty($clave)) {
				$ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
				$ssql6 = "update clients set Clave='$ClaveEncryp' where Email='$email'";
				$conn->query($ssql6);
			}

			$conn->close();
		?>
	</body>

	<footer id="fh5co-core-feature" role="contentinfo">
		<div class="container">
			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="https://twitter.com/CyberUrban1505"><i class="icon-twitter"></i></a></li>
							<li><a href="https://www.facebook.com/profile.php?id=61553871277103&is_tour_dismissed=true"><i class="icon-facebook"></i></a></li>
						</ul>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
</html>