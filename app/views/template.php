<html>
<head>
<meta charset="utf-8">
<title>gPs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ."/assets/css/style.css" ?>">
</head>

<body>
<div class="conteudo">	
	<div class="base-central">	
	<?php 
		include ('cabecalho.php');
		
		$this->load($view, $viewData, $viewData2);

		include ('rodape.php');

	
	?>
		
</div>	

</div>		
</body>
</html>