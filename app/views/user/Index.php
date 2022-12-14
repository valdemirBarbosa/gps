<div class="base-home">
	<h1 class="titulo-pagina">Acessar sistema</h1>
</div> <!-- FIM base-home -->
<div class="login">
	<form class="frmLogin" method="POST" action="<?php echo URL_BASE . 'User/logar' ?>" >
				<label>Usuario</label>
				<input name="credencial" autofocus type="text">
			
				<br><br>
			
				<label>senha</label>
				<input type="text" name="chave">

				<br><br>
			
				<input type="submit">
    </form>
    </div>