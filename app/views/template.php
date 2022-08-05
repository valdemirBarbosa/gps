<html>
<head>
<meta charset="utf-8">
<title>gPs</title>
<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
<link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/estilo.css" ?>" />
<!-- <link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/style.css" ?>" />
 <link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/bootstrap.min.css" ?>" />
!-->
</head>
<header>
		<div class="logo">GPS</div>
	<nav>
	<ul class="menu">
		<li><a href="<?php echo URL_BASE ?>" >Home</a></li>
		<li><a href="<?php echo URL_BASE . "denunciante" ?>" >Denunciantes</a></li>
		<li><a href="<?php echo URL_BASE . "denuncia" ?>" >Denuncias</a></li>
		<li><a href="<?php echo URL_BASE . "denunciado" ?>" >Denunciados</a></li>
		<li><a href="<?php echo URL_BASE . "servidor/" ?>" >Servidor</a></li>
		<li><a href="<?php echo URL_BASE . "processo/pp" ?>" >Processo Preliminar</a></li>
		<li><a href="<?php echo URL_BASE . "processo/sin" ?>" >Sindicância</a></li>
		<li><a href="<?php echo URL_BASE . "processo/pad" ?>" >PAD</a></li>
		<li><a href="<?php echo URL_BASE . "andamento/getAll" ?>">Andamentos</a></li>
		<li><a href="<?php echo URL_BASE . "portaria/" ?>">Portaria</a></li>
<!--		<li><a href="<?php //echo URL_BASE . "certidao/" ?>">Certidao</a></li> !-->
	</ul> 
	</nav>		
</header>


	<main>

			<?php 
				$this->load($view, $viewData, $viewData2);
			?>
	</main>
</body>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/jquery-3.3.1.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/bootstrap.bundle.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>
</html>
