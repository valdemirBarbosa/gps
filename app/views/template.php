<html>
<head>
<meta charset="utf-8">
<title>gPs</title>
<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
<link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/styleEstudo.css" ?>" />
<!-- <link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/style.css" ?>" />
 <link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/bootstrap.min.css" ?>" />
!-->
</head>
<body>

	<header>
		<div class="logo"></div>
	<nav>
	<ul class="menu">
		<li><a href="<?php echo URL_BASE ?>" >Home</a></li>
		<li><a href="<?php echo URL_BASE . "denunciante" ?>" >Denunciantes</a></li>
<!-- 		<li><a href="<?php echo URL_BASE . "denunciado" ?>" >Denunciados</a></li> -->
		<li><a href="<?php echo URL_BASE . "denuncia" ?>" >Denuncias</a></li>
		<li><a href="<?php echo URL_BASE . "servidor" ?>" >Servidores</a></li>
		<li><a href="<?php echo URL_BASE . "processo" ?>" >Processos</a></li>
		<li><a href="<?php echo URL_BASE . "andamento/getAll" ?>">Andamentos</a></li>
		<li><a href="<?php echo URL_BASE . "portaria" ?>">Portarias</a></li>
		<li><a href="<?php echo URL_BASE . "upload" ?>">Upload</a></li>
	</ul> 
</nav>		</header>
	
	<section class="container">

		<?php 
			$this->load($view, $viewData, $viewData2);
		?>

	</section>
</body>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/jquery-3.3.1.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/bootstrap.bundle.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>
</html>
