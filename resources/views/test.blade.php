<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('css/app2.css')}}">
</head>

<body>

	<div id="header">
		<div id="headerContent">
			<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
				<div class="container-fluid">
					<a class="navbar-brand" href="{{ url('/') }}"> FICH UNL </a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			</nav>
		</div>
	</div>

	<div id="page">
		<div id="sideBar">
			<div>
				box 1
			</div>
			<div>
				box 2
			</div>
		</div>
		<div id="content">
			content
		</div>
	</div>


</body>

</html>