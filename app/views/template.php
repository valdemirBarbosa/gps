<html>
<head>
<meta charset="utf-8">
<title>gPs</title>
<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
<link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/meu.css" ?>" />
<!--<link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/style.css" ?>" />
<link rel="stylesheet" href="<?php echo URL_BASE ."/assets/css/bootstrap.min.css" ?>" />
!-->
</head>

<body>
	<a href="index.php?link=1" class="logo"></a>
		<div class="base-busca">
				<form action="">
			<!--		<input type="text" placeholder="Pesquisa">
					<input type="submit" value="" class="but">
			!-->	</form>				
		</div>
</div>


<div class="container">	
		
	<?php 
		echo '<div class="">';
			include ('cabecalho.php');
		echo "</div>";
				
		$this->load($view, $viewData, $viewData2);

		include ('rodape.php');
	?>
	
</div>		
</body>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/jquery-3.3.1.min.js" ?>"> </script>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/bootstrap.bundle.min.js" ?>"> </script>

<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>
</html>