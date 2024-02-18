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
		<div class="fh5co-loader"></div>
		<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="container">
				<div class="row">	
					<div class="col-xs-2">
						<div id="fh5co-logo">CyberUrban</div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<form method="post">
							<ul>
								<li><button type="submit" name="InfoPers" class="btn btn-primary" data-toggle="modal">Información personal</button></li>
								<li><button type="submit" name="Inciden" class="btn btn-primary" data-toggle="modal">Incidencias</button></li>
								<li><button type="submit" name="Serv" class="btn btn-primary" data-toggle="modal">Servicios</button></li>
								<li><button type="submit" name="Reserv" class="btn btn-primary" data-toggle="modal">Reservas</button></li>
								<li><button type="submit" name="Progr" class="btn btn-primary" data-toggle="modal">Programas</button></li>
								<li><button type="submit" name="Reseny" class="btn btn-primary" data-toggle="modal">Reseñas</button></li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</nav>

		<?php
			$email = $_GET['cosa'];

			if (isset($_POST["InfoPers"])) {
				header("Location: InfoPersonalCl.php?cosa=$email");
			} elseif (isset($_POST["Inciden"])) {
				header("Location: InfoIncidenCl.php?cosa=$email");
			} elseif (isset($_POST["Serv"])) {
				header("Location: InfoServiCl.php?cosa=$email");
			} elseif (isset($_POST["Reserv"])) {
				header("Location: InfoReservesCl.php?cosa=$email");
			} elseif (isset($_POST["Progr"])) {
				header("Location: InfoProgrCl.php?cosa=$email");
			} elseif (isset($_POST["Reseny"])) {
				header("Location: InfoResenyesCl.php?cosa=$email");
			}
		?>

		<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm-2" role="banner" style="background-image:url(images/Img1.jpeg);">
		</header>

		<div id="fh5co-core-feature">
			<div class="container">
				<div class="row">
					<div class="features">
						<div class="col-half animate-box" data-animate-effect="fadeInLeft">
							<div class="desc">
								<h3>Días no disponibles</h3>
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

			$ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
			$result = mysqli_query($conn,$ObtenerID);
			$IDClient = mysqli_fetch_array($result);

			$sql = "SELECT DataReserva FROM reserves";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<table border='1' id='tabla' border='1'; width='520'>
						<tr>
							<th>Dia</th>
							<td>" . $row["DataReserva"] . "</td>
						</tr>";
				}
				echo "</table>";
			} else {
				echo "<p id='CentrarTextoTabla'>No hay reservas encontrados.</p>";
			}
			$conn->close();
		?>

		<div id="fh5co-core-feature">
			<div class="container">
				<div class="row">
					<div class="features">
						<div class="col-half animate-box" data-animate-effect="fadeInLeft">
							<div class="desc">
								<h3>Reservas propias</h3>
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

			$ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
			$result = mysqli_query($conn,$ObtenerID);
			$IDClient = mysqli_fetch_array($result);

			$sql = "SELECT IDReserva ,DataReserva FROM reserves where IDClient = (SELECT IDClient FROM clients WHERE IDClient = $IDClient[0])";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<table border='1' id='tabla' border='1'; width='520'>
						<tr>
							<th>Identificador</th>
							<td>" . $row["IDReserva"] . "</td>
						</tr>
						<tr>
							<th>Fecha</th>
							<td>" . $row["DataReserva"] . "</td>
						</tr>";
				}
				echo "</table>";
			} else {
				echo "<p id='CentrarTextoTabla'>No hay reservas encontrados.</p>";
			}
			$conn->close();
		?>

		<div id="button1">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5">Hacer reserva</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal6">Cancelar reserva</button>
		</div>

		<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="column" id="main">
								<form method="post" method="post" action="ReservaCl.php?cosa=<?php echo urlencode($email); ?>">
									<div class="form-group">
										<label for="exampleInputEmail1">Fecha</label>
										<input type="date" class="form-control" name="InputDate1" id="InputDate1" aria-describedby="emailHelp" placeholder="Fecha">
									</div>
									<button name="AnyaHacRes" type="submit" class="btn btn-primary">Hacer reserva</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="column" id="main">
								<form method="post" method="post" action="ReservaCl.php?cosa=<?php echo urlencode($email); ?>">
									<div class="form-group">
										<label for="exampleInputEmail1">Identificador</label>
										<input type="text" class="form-control" name="InputDate2" id="InputDate2" aria-describedby="emailHelp" placeholder="Identificador">
									</div>
									<button name="AnyaCanRes" type="submit" class="btn btn-primary">Cancelar reserva</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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