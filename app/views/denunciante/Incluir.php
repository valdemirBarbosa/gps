<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>Ocorrencias/Denunciante</h1>
</div>
			<!--Botões !-->
			<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			

<form action="<?php echo URL_BASE ."denunciante/Salvar" ?>" method="POST">
	<fieldset>
		<label>Nome/Descrição do denunciante</label>
		<input required autofocus  type="text" placeholder="Insira o nome/descrição do denunciante">
	</fieldset>


	<fieldset>
		<div class="obs">	
			<label>observação</label>
			<textarea  name="txt_observacao" rows="5" cols="100">
			</textarea>
		</div>
	</fieldset>



	<fieldset>
		<div class="botoes">
			<input type="hidden" name="acao" value="Cadastrar">
			<input type="hidden" name="id" value="">
			<input type="submit" value="Cadastrar" class="btn-inc">
			<input type="reset" name="Reset" id="button" value="Limpar" class="btn-inc">
		</div>	
	</fieldset>
</form>
	