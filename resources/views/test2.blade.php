<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="csrf-token" content="rAzFMCvv4fprPr19fGs1oItJEUuRBjBou2BOCp6Q">

	<title>Craftable - Craftable</title>
	<link href="/css/admin.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">

	<!-- NAVBAR -->
	<header class="app-header navbar">
		<!-- Hidden Burger icon -->
		<button class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
			<span class="navbar-toggler-icon"></span>
		</button>

		<a href="http://127.0.0.1:8000/admin" class="navbar-brand">
			<h1>UNL</h1>
		</a>
		<!-- Nav's Right side -->
		<ul class="nav navbar-nav ml-auto">
			<li class="nav-item dropdown">

				<a role="button" class="dropdown-toggle nav-link">
					<span>
						<span class="hidden-md-down"> Administrator Administrator </span>
					</span>
					<span class="caret"></span>
				</a>

				<div class="github-link">
					<a href="https://github.com/BRACKETS-by-TRIAD/craftable-demo" target="_blank">
						<img src="http://127.0.0.1:8000/images/vendor/craftable/GitHub_Logo.png" alt="">
					</a>
				</div>

				<div class="dropdown-menu dropdown-menu-right">
					<div class="dropdown-header text-center"><strong>Account</strong></div>
					<a href="http://127.0.0.1:8000/admin/profile" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
					<a href="http://127.0.0.1:8000/admin/password" class="dropdown-item"><i class="fa fa-key"></i> Password</a>
					<a href="http://127.0.0.1:8000/admin/logout" class="dropdown-item"><i class="fa fa-lock"></i> Logout</a>
				</div>
				
			</li>
		</ul>

	</header> <!-- /NAVBAR -->


	<div class="app-body">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<nav class="sidebar-nav ps">
				<ul class="nav">
					<li class="nav-title">Principal</li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/articles"><i class="nav-icon icon-plane"></i>Proyectos</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/posts"><i class="nav-icon icon-globe"></i> Herramientas</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/translatable-articles"><i class="nav-icon icon-ghost"></i> Relevamientos</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/exports"><i class="nav-icon icon-drop"></i> Graficar Datos</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/articles-with-relationships"><i class="nav-icon icon-graduation"></i> Registrar Docente</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/bulk-actions"><i class="nav-icon icon-book-open"></i> #6: Bulk Actions</a></li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/tags"><i class="nav-icon icon-tag"></i> #7: Tags</a></li> -->

					<li class="nav-item"> </li>
					<li class="nav-title">Administrativo</li>
					<li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8000/admin/admin-users"><i class="nav-icon icon-user"></i> Administrar Usuarios</a></li>

				</ul>

				<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
					<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
				</div>
				<div class="ps__rail-y" style="top: 0px; right: 0px;">
					<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
				</div>
			</nav>
			<button class="sidebar-minimizer brand-minimizer" type="button"></button>
		</div> <!-- SIDEBAR -->

		<!-- CONTENT -->
		<main class="main">

			<div id="app" class="container-fluid">
				<div class="modals">
					<!---->
				</div>
				<div>
					<div class="notifications" style="width: 300px; bottom: 0px; right: 0px;"><span></span></div>
				</div>
				<div class="welcome-quote">
					CONTENT
				</div>
			</div>

		</main><!-- CONTENT -->

	</div>



	<!-- <footer class="app-footer">
		<div class="container-fluid">
			<div class="container-xl">
				<span class="pull-right">
					Powered by <a href="https://docs.brackets.sk/" target="_blank">Craftable.</a>
				</span>
			</div>
		</div>
	</footer> -->

	<script src="/js/admin.js"></script>

</body>

</html>