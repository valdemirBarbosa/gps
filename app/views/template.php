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
		<li><a href="<?php echo URL_BASE . "servidor/" ?>" >Servidor</a></li>
		<li><a href="<?php echo URL_BASE . "processo/pp" ?>" >Processo Preliminar</a></li>
		<li><a href="<?php echo URL_BASE . "processo/sin" ?>" >Sindicância</a></li>
		<li><a href="<?php echo URL_BASE . "processo/pad" ?>" >PAD</a></li>
		<li><a href="<?php echo URL_BASE . "andamento/getAll" ?>">Andamentos</a></li>
		<li><a href="<?php echo URL_BASE . "portaria/" ?>">Portaria</a></li>
		<li><a href="<?php echo URL_BASE . "upload" ?>">Upload</a></li>
	</ul> 
	</nav>		
</header>


	<main>

 	<section class="container">
		<?php 
			$this->load($view, $viewData, $viewData2);
		?>

 		<form action="" method="POST" action="jogo">
			<label>Números Jogados </label>
			<input type="text" name="jogo">
			<input type="submit">
		<label> Acertos </label><br/>
		<label>   </label>
		</form>

		<?php 
					$resultado = array(1, 4, 5, 6, 8, 9, 10, 11, 12, 14, 15, 19, 20, 21, 24);
					$jogo = array(4, 5, 6, 7, 8,  9, 11, 12, 14, 17, 18, 19, 20, 21, 24 );

					for($i = 0; $i <15; $i++){
						
/* 					echo "<pre>";
						print_r($resultado[$i]);
						echo " - ";
						print_r($jogo[$i]);
					echo "<pre>";
 */
					if($resultado[$i] == $jogo[$i]){
						echo "Acertos: ".print_r($resultado)."<br/>";
					}
				}

			    //    $jogo = array(4, 5, 6, 7, 8,  9, 11, 12, 14, 17, 18, 19, 20, 21, 24 );

/* 
			if(!empty($_POST['jogo'])){
				$jogo = $_POST['jogo'];
				$NumeroJogo = array($_POST['jogo']);

				$qtde = count($resultado);
				for($x = 0; $x < $qtde; $x++){
					if(in_array($resultado[0], $NumeroJogo));{
						print_r(in_array($resultado[$x], $NumeroJogo));	
							$resultado = $resultado[$x];
					}
						foreach($resultado as $r){
							echo $r;	
						}	

							}				} */
		?>


<!-- 	</section>
 -->	
</main>

<footer>
	Sitema de Gerenciamento de Processos de Sindicância e Processo Administrativo
<footer>

</body>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/jquery-3.3.1.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/bootstrap.bundle.min.js" ?>"> </script>
	<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>
</html>
