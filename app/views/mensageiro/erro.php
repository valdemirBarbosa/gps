<!DOCTYPE html>
<html lang="pt-BR">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mensageria</title>
</head>
<body>

    <div class="erros">
        <?php 
            //Mensagem vindo da classe MensageiroController método Error. Solicitado pela função verData da classe FaseController
            echo $viewData2; ?>
		<div>
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '"><div class="btn-msg-erro">Voltar</div></a>');
				</script>
		</div>			

    </div>

        
</body>
</html>