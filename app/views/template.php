<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])){
        $horaAtual = time();
        $horaDeAcesso = $_SESSION['horaDeAcesso'];
        $tempoOnline = $horaAtual - $horaDeAcesso;
        $_SESSION['tempoOnLine'] = $tempoOnline; 

        $_SESSION['id_usuario'];
    ?>
        <html>
        <head>
        <title>gPs</title>
        <meta charset="utf-8">	
        <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
        <link rel="stylesheet" href="<?php echo URL_BASE . 'assets/css/estilo.css' ?>" />
        </head>
        <header>
        		<div class="logo">GPS</div>
        	<nav>
        	<ul class="menu">
        <!--<li><a href="<?php //echo URL_BASE ?>" >Home</a></li>
     		<li><a href="<?php echo URL_BASE . "comissao" ?>" >Comissão</a></li>
    		<li><a href="<?php// echo URL_BASE . "Denunciante" ?>" >Denunciantes</a></li> 
    	-->	
        		<li><a href="<?php echo URL_BASE . "denuncia" ?>" >Denuncia</a></li>
        		<li><a href="<?php echo URL_BASE . "denunciado" ?>" >Denunciado</a></li>
         		<li><a href="<?php echo URL_BASE . "processo/pp" ?>" >Processo Preliminar</a></li>
         		<li><a href="<?php echo URL_BASE . "processo/sin" ?>" >Sindicância</a></li>
         		<li><a href="<?php echo URL_BASE . "processo/pad" ?>" >PAD</a></li>
        		<li><a href="<?php echo URL_BASE . "andamento/getAll" ?>">Andamentos</a></li>
        		<li><a href="<?php echo URL_BASE . "portaria" ?>">Portaria</a></li>
        		<li><a href="<?php echo URL_BASE . "finalizados" ?>">Finalizados</a></li>
        		<li><a href="<?php echo URL_BASE . "certidao" ?>">Certidao</a></li> 
    	        <li><a href="#"><?php echo 'tempo online: '.$_SESSION['tempoOnLine'] ?></a></li> 
        		<li><a href="<?php echo URL_BASE . "finalizar" ?>">Sair</a></li> 

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
<?php
    }else{
        header("Location: index.php");
    }
    
         if($_SESSION['tempoOnLine'] > 86400){
             session_destroy();
             header("Location: index.php");
        }

    
    ?>