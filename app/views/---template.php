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

<div class="container">	
	<?php 
		include ('cabecalho.php');
				
		$this->load($view, $viewData, $viewData2);

	 	include ('rodape.php'); 
 	?>
	
</div>		

</body>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/jquery-3.3.1.min.js" ?>"> </script>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/bootstrap.bundle.min.js" ?>"> </script>

<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>
</html>