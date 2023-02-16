<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])){
        $horaAtual = time();
        $horaDeAcesso = $_SESSION['horaDeAcesso'];
        $tempoOnline = $horaAtual - $horaDeAcesso;
        $_SESSION['tempoOnLine'] = $tempoOnline; 
?>
        <html>
        <div class="areaPrincipal">
            <head>
                <title>gPs</title>
                <meta charset="utf-8">	
                <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
                 <link rel="stylesheet" href="<?php echo URL_BASE; ?>assets/css/bootstrap.min.css" />
                <link rel="stylesheet" href="<?php echo URL_BASE; ?>assets/css/estilo.css" />
            </head>

            <header>
                    <div class="logo">GPS</div>
                <nav>
                    <ul class="menu">
                        <li><a href="<?php echo URL_BASE . "denuncia" ?>" >Denuncia</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "denunciado" ?>" >Denunciado</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "processo/pp" ?>" >Processo Preliminar</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "processo/sin" ?>" >Sindicância</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "processo/pad" ?>" >PAD</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "andamento/getAll" ?>">Andamentos</a></li><br/>
                        <li><a href="<?php echo URL_BASE . "portaria" ?>">Portaria</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "finalizados" ?>">Finalizados</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "certidao" ?>">Certidao</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "finalizar" ?>">Sair</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "certidao" ?>">Certidao</a></li>&nbsp
                        <li><a href="<?php echo URL_BASE . "finalizar" ?>">Sair</a></li>&nbsp
                    </ul> 
                </nav>		
            </header>
        <body>

        <main>
            <?php 
                $this->load($view, $viewData, $viewData2);
            ?>
        </main>
    
    <?php
        }else{
            header("Location: index.php");
        }
        
            if($_SESSION['tempoOnLine'] > 86400){
                session_destroy();
                header("Location: index.php");
            }
    ?>    
</div>
 <!--       <script type="text/javascript" src="<?php echo URL_BASE; ?>assets/js/jquery-3.3.1.min.js"> </script>
        <script type="text/javascript" src="<?php URL_BASE;  ?>assets/js/script.js"> </script>
        --></body>
    <?php include "rodape.php"; ?> 
</html>