<?php
	require 'config/config.php';
	require 'app/core/Core.php';
	require 'vendor/autoload.php';

    session_start();

if(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])){
    $core = new Core;
    $core->run();
    exit;
}else{
    if(isset($_POST['credencial']) && !empty($_POST['credencial'])){
        $horaDeAcesso = time();
        $_SESSION['horaDeAcesso'] = $horaDeAcesso;
        $email = addslashes($_POST['credencial']);
        $chave = md5(addslashes($_POST['chave']));
        $senha = $chave;

        try{
            $db = new PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $sql = $db->query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");
                if($sql->rowCount() > 0){
                 $dado = $sql->fetch();
                 $id_usuario = $dado[0];
                 $nome = strtolower($dado[1]);

                 $_SESSION['id_usuario'] = $id_usuario;
                 $_SESSION['nome'] = $nome;
                 
                 header("Location: index.php");
            }else{
                header("Location: index.php");
                die();
            }
        }catch(PDOException $e){
            echo "Falha na conexão ".$e;
        }
    }
}

    ?>
	<html>
	<head>
	<meta charset="utf-8">
	<title>gPs</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
	<link rel="stylesheet" href="assets/css/estilo.css" />
	</head>
    <body>

    <div class="base-home">
    	<h1 class="titulo-pagina">Acessar sistema GPS Gerenciador de Processo de Sindicância</h1>
    </div> <!-- FIM base-home -->
    <div class="login">
    	<form class="frmLogin" method="POST">
        <div class="mensagemExisteUsuario">
              <?php   		
        		if(isset($_SESSION['msg'])){
                    echo "Mensagem: " . $_SESSION['msg'];
                    //session_destroy();
                }?>
          </div>
          <br>
    		<label>Usuario</label>
    		<input name="credencial" autofocus type="text">
        		<br><br>
    		<label>senha</label>
    		<input type="password" name="chave">
    		<input type="submit" value="Entrar">
    			<br><br>
    		<div class="linkAcesso1">
                <a href="primaccess.php">Clique aqui para criar acesso</a>
            </div>
    </form>
</div>
    </body>
</html>    
