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
						<div id="fh5co-logo"><a href="InfoPersonalTr.php">CyberUrban</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="index.html">InfoPersonalTr</a></li>
							<li><a href="about.html">InfoIncidenTr</a></li>
							<li><a href="services.html">InfoDepSerProg</a></li>
							<li><a href="programas.html">InfoProgrTr</a></li>
							<li><a href="work.html">InfoResenyesTr</a></li>
							<li><a href="contact.html">InfoServiTr</a></li>
							<li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Login</button></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>

		<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm-2" role="banner" style="background-image:url(images/Img1.jpeg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1>CyberUrban</h1>
								<h2>Empresa de ciberseguridad Española</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
        <?php
        // Configuración de la base de datos
                $host = "localhost";
                $usuario = "root";
                $contrasena = "";
                $base_datos = "cyberurban";
                // Definir la variable email
                $email = isset($_GET['EmailLogin']) ? $_GET['EmailLogin'] : '';
                // Conexión a la base de datos
                $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión a la base de datos: " . $conexion->connect_error);
                }

                // Prevenir inyección SQL
                $email = $conexion->real_escape_string($email);

                // Consulta SQL para obtener la información del trabajador con el correo electrónico proporcionado
                $sql = "SELECT * FROM treballadors WHERE Email = '$email' ";
                $result = $conexion->query($sql);
				
                // Verificar si se obtuvieron resultados
                if ($result->num_rows > 0) {
                    // Imprimir la tabla
                    echo "<table border='1'>
                            <tr>
                                <th>NomTreballador</th>
                                <th>Email</th>
                                <th>Número de teléfono</th>
                                <!-- Agrega más columnas según tu esquema de base de datos -->
                            </tr>";

                    // Imprimir datos de cada fila
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["NomTreballador"] . "</td>
                                <td>" . $row["Email"] . "</td>
                                <td>" . $row["Telefon"] . "</td>
                                <!-- Agrega más celdas según tu esquema de base de datos -->
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontraron resultados.";
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();
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